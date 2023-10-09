<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cinco dados</h1>
    <p>Actualice la página para mostrar una nueva tirada.</p>
    <table>
        <?php

        define ('DADO1',  "&#9856;");
        define ('DADO2',  "&#9857;");
        define ('DADO3',  "&#9858;");
        define ('DADO4',    "&#9859;" );
        define ('DADO5',  "&#9860;");
        define ('DADO6',    "&#9861;" );

        $dados = [    1 => DADO1,
        DADO2,
        DADO3,
        DADO4,
        DADO5,
        DADO6
        ];
        
        $jugador1 = [];
        $jugador2 = [];


        echo "<tr><th>Jugador1: </th><td> <font size='7'>";
        for ($i = 0; $i < 6; $i++) {
            $num = random_int(1, 6);
            echo $dados[$num];
            $jugador1[$i] = $num;
        }
        echo "</td><th>" . eliminar($jugador1) . " puntos </th></tr>";
        echo "<tr><th>Jugador2: </th><td><font size='7'>";
        for ($i = 0; $i < 6; $i++) {
            $num = random_int(1, 6);
            echo $dados[$num];
            $jugador2[$i] = $num;
        }
        echo "</td><th>" . eliminar($jugador2) . " puntos</th></tr>";
        if (eliminar($jugador1) > eliminar($jugador2))
            echo "<tr><th> Resultado<th> <td>Ha Ganado el Jugador 1</td></tr>";
        else
            echo "<tr><th> Resultado<th> <td>Ha Ganado el Jugador 2</td></tr>";

        function eliminar($jugador)
        {
            $max = 0;
            $min = 7;
            $total = 0;
            for ($i = 0; $i < 6; $i++) {
                if ($max < $jugador[$i]) {
                    $max = $jugador[$i];
                }
                if ($min > $jugador[$i]) {
                    $min = $jugador[$i];
                }
                $total = $jugador[$i] + $total;
            }
            $total = $total - $min - $max;
            return $total;
        }

        ?>

    </table>
</body>

</html>
