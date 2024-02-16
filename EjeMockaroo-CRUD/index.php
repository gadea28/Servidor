<?php
session_start();
define ('FPAG',10); // Número de filas por página


require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';
require_once 'app/models/Cliente.php';
require_once 'app/models/AccesoDatosPDO.php';
require_once 'app/controllers/crudclientes.php';

//Esta parte no funciona
//if (!isset($_SESSION['usuario'])) {
//    header('Location: app\views\login.php');
//    exit();
//}


//---- PAGINACIÓN ----
$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];
//------------

// Borro cualquier mensaje "
$_SESSION['msg']=" ";

ob_start(); // La salida se guarda en el bufer
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    // Proceso las ordenes de navegación
    if ( isset($_GET['nav'])) {
        switch ( $_GET['nav']) {
            case "Primero"  : $posAux = 0; break;
            case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
            case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
            case "Ultimo"   : $posAux = $posfin;
        }
        $_SESSION['posini'] = $posAux;
    }


     // Proceso las ordenes de navegación en detalles
    if ( isset($_GET['nav-detalles']) && isset($_GET['id']) ) {
     switch ( $_GET['nav-detalles']) {
        case "Siguiente": crudDetallesSiguiente($_GET['id']); break;
        case "Anterior" : crudDetallesAnterior($_GET['id']); break;
        
    }
     }
     if ( isset($_GET['nav-modificar']) && isset($_GET['id']) ) {
        switch ( $_GET['nav-modificar']) {
           case "Siguiente": crudModificarSiguiente($_GET['id']); break;
           case "Anterior" : crudModificarAnterior($_GET['id']); break;
           
       }
    }

    // Proceso de ordenes de CRUD clientes
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : crudAlta(); break;
            case "Ordenar"  : crudOrdenar($_GET['ord']); break;
            case "Borrar"   : crudBorrar   ($_GET['id']); break;
            case "Modificar": crudModificar($_GET['id']); break;
            case "Detalles" : crudDetalles ($_GET['id']);break;
            case "Terminar" : crudTerminar(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : crudPostAlta(); break;
             case "Modificar": crudPostModificar(); break;
             case "Ordenar"  : crudPostOrdenar($_POST['ord']); break;
             case "Detalles":; // No hago nada
         }
    }
}

// Si no hay nada en la buffer 
// Cargo genero la vista con la lista por defecto
if(!isset($_SESSION['ordenacion']))
    $_SESSION['ordenacion'] = "id";

if (isset($_GET['ordenacion']))
    $_SESSION['ordenacion'] = $_GET['ordenacion'];

if ( ob_get_length() == 0){
    $valor=0;
    $db = AccesoDatos::getModelo();
    $posini = $_SESSION['posini'];
    (isset($_SESSION["ordenacion"])? $valor = $_SESSION["ordenacion"]:$valor="id");
    (isset($_SESSION["ordenAD"])? $valorAD = $_SESSION["ordenAD"]:$valorAD="ASC");
    $tvalores = $db->getClientes($posini,FPAG, $valor,$valorAD);
    require_once "app/views/list.php";    
}

$contenido = ob_get_clean();
$msg = $_SESSION['msg'];
// Muestro la página principal con el contenido generado
require_once "app/views/principal.php";



