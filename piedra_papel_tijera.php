<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>¡Piedra, papel, tijera!</h1>
    <p>Actualice la pagina para motrar otra partida </p>
    <table>
        <tr>
            <th>Jugador1</th>
            <th>Jugador2</th>
            <?php
            define('PIEDRA1',  "&#x1F91C;");
            define('PIEDRA2',  "&#x1F91B;");
            define('TIJERAS',  "&#x1F596;");
            define('PAPEL',    "&#x1F91A;");


            $var1 = random_int(0,2);
            $var2 = random_int(0,2);

            $mano1 = [PIEDRA1, TIJERAS, PAPEL];
            $mano2 = [PIEDRA2, TIJERAS, PAPEL];
        
            function resultado2 ($var1, $var2){
                //terminar mas tarde
            }

            function resultado ($var1, $var2){
                if (($var1 == 0 && $var2 == 0) | ($var1 == 1 && $var2 == 1) || ($var1 == 2 && $var2 == 2)) {
                    $empate = '¡Empate!';
                    return $empate;
                } else if (($var1 == 0 && $var2 == 1) || ($var1 == 1 && $var2 == 2) || ($var1 == 2 && $var2 == 0)){
                    $ganador1 = 'Ha ganado el jugador 1';
                    return $ganador1;
                } else if (($var1 == 1 && $var2 == 0) || ($var1 == 2 && $var2 == 1) || ($var1 == 0 && $var2 == 2)) {
                    $ganador2 = 'Ha ganado el jugador 2';
                    return $ganador2;
                }
            }
            

            ?>

<tr>
                <td style="font-size: 5rem"> <?= $mano1[$var1] ?> </span></td>
                <td style="font-size: 5rem"> <?= $mano2[$var2] ?></span></td>
                </tr>
                <tr>
                    <th colspan="2"> <?= resultado($var1, $var2)?></th>
                    
                </tr>
            </table>

</body>

</html>
