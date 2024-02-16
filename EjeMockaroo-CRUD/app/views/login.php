<?php
//No funciona
require_once '../models/AccesoDatosPDO.php';
require_once '../config/configDB.php';
// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre de usuario y la contraseña proporcionados por el usuario
    $username = $_POST['username'];
    $passwordcif = $_POST['password'];
    $password =md5($passwordcif);

    // Obtener una instancia de la clase AccesoDatos
    $accesoDatos = AccesoDatos::getModelo();

    // Consultar la base de datos para obtener el usuario
    $usuario = $accesoDatos->getUsuarioPorUsername($username);

    if ($usuario) {
        // Verificar la contraseña
        if (password_verify($password, $usuario['password'])) {
            // La contraseña es correcta, el usuario puede iniciar sesión
            // Redirigir a la página principal o realizar otras acciones necesarias
            header('Location: ../../index.php');
            exit();
        } else {
            // La contraseña no coincide, mostrar un mensaje de error
            echo "Contraseña incorrecta. Por favor, inténtelo de nuevo.";
        }
    } else {
        // No se encontró un usuario con ese nombre, mostrar un mensaje de error
        echo "Usuario no encontrado. Por favor, inténtelo de nuevo.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>

    <?php if (isset($error)) : ?>
        <p><?= $error ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>

</body>
</html>
