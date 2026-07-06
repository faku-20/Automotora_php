<?php
require_once 'app/funciones.php';

if (estaLogueado()) {
    if (esAdministrador()) {
        header('Location: views/principalAdministrador.php');
        exit();
    } else {
        header('Location: views/principalComprador.php');
        exit();
    }
}

$error = '';
if (isset($_GET['error'])) {
    $error = limpiar($_GET['error']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Automotora - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="login">
        <h1>Automotora</h1>
        <h2>Inicio de sesión</h2>

        <?php if ($error != '') { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST" action="app/login.php">
            <label>Usuario</label>
            <input type="text" name="usuario" required>

            <label>Contraseña</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="ayuda">
            <p><strong>Administrador:</strong> admin1 / 123456</p>
            <p><strong>Comprador:</strong> comprador1 / 123456</p>
        </div>
    </div>
</body>

</html>