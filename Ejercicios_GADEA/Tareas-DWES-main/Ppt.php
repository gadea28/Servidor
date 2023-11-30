<?php

 define ('PIEDRA1',  "&#x1F91C;");
 define ('PIEDRA2',  "&#x1F91B;");
 define ('TIJERAS',  "&#x1F596;");
 define ('PAPEL',    "&#x1F91A;" );

    $var1 = random_int(1, 4); 
    $var2 = random_int(2, 4);

    function jug1($var1) {
        if ($var1 == 1 || $var1 == 2) {
            return PIEDRA1;
        } else if ($var1 == 4 ) {
            return PAPEL;
        } else if ($var1 == 3 ){
            return TIJERAS;
        }       
    }

    function jug2($var2) {
        if ($var2 == 2) {
            return PIEDRA2;
        } else if ($var2 == 4) {
            return PAPEL;
        } else if ($var2 == 3) {
            return TIJERAS;
        }
    }

    function resultado ($var1, $var2){
        if (($var1 == 1 && $var2 == 2) || ($var1 == 3 && $var2 == 3) || ($var1 == 4 && $var2 == 4)) {
            $empate = '¡Empate!';
            return $empate;
        } else if (($var1 == 1 && $var2 == 3) || ($var1 == 2 && $var2 == 3) || ($var1 == 4 && $var2 == 1) || ($var1 == 3 && $var2 == 4) || ($var1 == 4 && $var2 == 2)){
            $ganador1 = 'Ha ganado el jugador 1';
            return $ganador1;
        } else if (($var1 == 3 && $var2 == 1) || ($var1 == 3 && $var2 == 2) || ($var1 == 1 && $var2 == 4) || ($var1 == 4 && $var2 == 3) || ($var1 == 2 && $var2 == 4)) {
            $ganador2 = 'Ha ganado el jugador 2';
            return $ganador2;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Piedra, Papel o Tijeras </title>
    </head>
    <body>
        <h1> ¡Piedra, papel, tijera! </h1>
            <p> Actualice la página para mostrar </p>
            <table>
                <tr>
                    <th> Jugador 1 </th>
                    <th> Jugador 2 </th>
                </tr>
 
                <tr>
                <td> <span style="font-size: 5rem"> <?= jug1($var1) ?> </span></td>
                <td> <span style="font-size: 5rem"> <?= jug2($var2) ?></span></td>
                </tr>
                <tr>
                    <th colspan="2"> <?= resultado($var1, $var2)?></th>
                </tr>
            </table>
    </body>
</html> 
