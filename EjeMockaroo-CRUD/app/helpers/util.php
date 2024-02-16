<?php

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}
function obtenerPaisPorIP($ip) {
    $url = "http://ip-api.com/json/{$ip}";
    $respuesta = file_get_contents($url);
    $datos = json_decode($respuesta, true);
    if ($datos["status"] == "fail")
        return "https://services.meteored.com/img/article/por-que-a-pressao-no-fundo-dos-oceanos-e-tao-forte-1687621720483_768.png";
    $pais = strtolower($datos['countryCode']);
    return "https://flagpedia.net/data/flags/w580/{$pais}.webp";
    }

    ?>
    