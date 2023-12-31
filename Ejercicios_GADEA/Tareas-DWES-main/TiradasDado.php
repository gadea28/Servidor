<?php

define ('DADO1',  "&#9856;");
define ('DADO2',  "&#9857;");
define ('DADO3',  "&#9858;");
define ('DADO4',    "&#9859;" );
define ('DADO5',  "&#9860;");
define ('DADO6',    "&#9861;" );

$Dados = [
    1 => DADO1,
    DADO2,
    DADO3,
    DADO4,
    DADO5,
    DADO6
];

function Jugada($Array, int $num) {
    $Tirada = [];
    for ($i = 0; $i < $num; $i++) {
        $Tirada[$i] = array_rand($Array);
    }
    return $Tirada;
}

function DadoMenor($Array) {
    $Menor = 7;
    for ($i = 1; $i <=sizeof($Array)-1; $i++) {
        if ($Array[$i]<$Menor) {
            $Menor=$Array[$i];
        }
    }
    return $Menor;
}

function DadoMayor($Array) {
    $Mayor = 0;
    for ($i = 1; $i <=sizeof($Array)-1; $i++) {
        if ($Array[$i]>$Mayor) {
            $Mayor=$Array[$i];
        }
    }
    return $Mayor;
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Cinco Dados </title>
    </head>
    <body>
        <h1> El juego de los cinco dados </h1>
            <p> Actualice la página para mostrar una nueva tirada. </p>
            <?php
                $resultado1 = 0;
                $resultado2 = 0;

                $TJugador1 = [];
                $TJugador2 = [];

                echo "JUGADOR ROJO:";
                $TJugador1 = jugada($Dados, 6);
                foreach ($TJugador1 as $clave2 => $valor2) {
                    $resultado1 += $valor2;
                    echo  "<span style='font-size:4rem'>$Dados[$valor2]</span> ";
                }

                $ValorMayor = DadoMayor($TJugador1);
                $ValorMenor = DadoMenor($TJugador1);

                echo $resultado1=$resultado1-$ValorMayor - $ValorMenor;
                echo " Puntos<br>";


                echo "JUGADOR AZUL:";
                $TJugador2 = jugada($Dados, 6);
                foreach ($TJugador2 as $clave3 => $valor3) {
                    $resultado2 += $valor3;
                    echo  "<span style='font-size:4rem'>$Dados[$valor3]</span> ";
                }

                $ValorMayor = DadoMayor($TJugador2);
                $ValorMenor = DadoMenor($TJugador2);

                echo $resultado2=$resultado2-$ValorMayor - $ValorMenor;
                echo " Puntos<br>";

                if($resultado1>$resultado2) {
                    echo "<strong>Resultado</strong> ¡Ha Ganado el Jugador 1!";
                } else if($resultado1<$resultado2) {
                    echo "<strong>Resultado</strong> ¡Ha Ganado el Jugador 2!";
                }else echo "<strong>Resultado</strong> Empate de puntos, tira de nuevo";

            ?>
            
    </body>
</html> 
