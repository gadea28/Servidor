<?php

function crudBorrar ($id){    
    $db = AccesoDatos::getModelo();
    $resu = $db->borrarCliente($id);
    if ( $resu){
         $_SESSION['msg'] = " El usuario ".$id. " ha sido eliminado.";
    } else {
         $_SESSION['msg'] = " Error al eliminar el usuario ".$id.".";
    }

}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formularioNuevo.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    include_once "app/views/detalles.php";
}

function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";
    include_once "app/views/formulario.php";
}

function crudDetallesSiguiente($id){
   
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    if (!$cli) return false; //No hay mas clientes vueleve a la pagina de inicio
    include_once "app/views/detalles.php";
}

function crudDetallesAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    if  (!$cli) return true; //Si no hay mas clientes vuelve a la pagina de inicio
   include_once "app/views/detalles.php";

}
function crudModificarSiguiente($id){
   
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteSiguiente($id);
    if (!$cli) return false; //No hay mas clientes vueleve a la pagina de inicio
    $orden="Modificar";
    include_once "app/views/formulario.php";
}
function crudModificarAnterior($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getClienteAnterior($id);
    if  (!$cli) return true; //Si no hay mas clientes vuelve a la pagina de inicio
    $orden="Modificar";
    include_once "app/views/formulario.php";

}
function crudOrdenar($orden)
{
   $_SESSION['msg'] = "Ordenando por $orden";
   // Lógica para ordenar por $orden (nombre, apellido, correo, género, IP)
}


 function validarDatos($datos){
    // Verificar si todos los datos necesarios están presentes
    if (isset($datos['id'], $datos['first_name'], $datos['last_name'], $datos['email'], $datos['gender'], $datos['ip_address'], $datos['telefono'])) {

        // Realizar validaciones específicas
        $errores = [];

        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Error: El formato del correo electrónico no es válido.";
            
        }
        $db = AccesoDatos::getModelo();
        if($db->correoRepetido($datos['email'],$datos['id'])) {
            $errores[] = "Error: Correo Electrónico Duplicado";
        }

        if (!filter_var($datos['ip_address'], FILTER_VALIDATE_IP)) {
            $errores[] = "Error: La dirección IP no es válida.";
        }

        if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $datos['telefono'])) {
            $errores[] = "Error: El formato del teléfono no es válido (debe ser 999-999-9999).";
        }
        $texto = implode("<br>", $errores);
        return $texto;
    } else {
        
        return "Error: Faltan datos obligatorios.";
    }
}



function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
     $validacion = validarDatos($_POST);
    
     // Si hay errores de validación, mostrar mensaje y salir
     if (!empty($validacion)) {
         $_SESSION['msg'] = $validacion;
         return;
     }
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    $db = AccesoDatos::getModelo();
    if ( $db->addCliente($cli) ) {
           $_SESSION['msg'] = " El usuario ".$cli->first_name." se ha dado de alta ";
        } else {
            $_SESSION['msg'] = " Error al dar de alta al usuario ".$cli->first_name."."; 
        }
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $validacion = validarDatos($_POST);
    
    // Si hay errores de validación, mostrar mensaje y salir
    if (!empty($validacion)) {
        $_SESSION['msg'] = $validacion;
        return;
    }
    if (!empty($_FILES['foto']['name'])) {
        $allowedFormats = ['jpg', 'png'];
        $maxFileSize = 500 * 1024; // 500 Kbps

        $fileExtension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $fileSize = $_FILES['foto']['size'];

        if (!in_array($fileExtension, $allowedFormats) || $fileSize > $maxFileSize) {
            $_SESSION['msg'] = "Error: La imagen debe ser jpg o png y tener un tamaño inferior a 500 Kbps.";
            header("Location: principal.php"); // Redirigir a la página de inicio
            exit();
        }
    }
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    
    $db = AccesoDatos::getModelo();
    if ( $db->modCliente($cli) ){
        $_SESSION['msg'] = " El usuario ha sido modificado";
    } else {
        $_SESSION['msg'] = " Error al modificar el usuario ";
    }
    
}
function crudPostOrdenar($orden){
    $_SESSION['msg'] = $orden;

}
function obtenerURLImagenCliente($idCliente) {
    if  ($idCliente >9) 
    $rutaImagen = "app/uploads/000000" . $idCliente . ".jpg";
    else
    $rutaImagen = "app/uploads/0000000" . $idCliente . ".jpg";
    // Verificar si la imagen existe
    if (file_exists($rutaImagen)) {
        return $rutaImagen;
    } else {
        return "https://robohash.org/{$idCliente}.png";
    }
}