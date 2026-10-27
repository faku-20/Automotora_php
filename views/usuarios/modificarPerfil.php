<?php
require_once '../../app/funciones.php';
protegerPagina();

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = limpiar($_POST['nombre']);
    $apellido = limpiar($_POST['apellido']);
    $contrasenaNueva = $_POST['contrasena'];

    if (campoVacio($nombre) || campoVacio($apellido)) {
        $error = 'Nombre y apellido son obligatorios.';
    } else {
        modificarUsuarioActual($nombre, $apellido, $contrasenaNueva);
        $mensaje = 'Perfil modificado correctamente.';
    }
}

if (esAdministrador()) {
    $volver = '../administrador/principal.php';
} else {
    $volver = '../comprador/principal.php';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar perfil</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="barra">
        <h1>Modificar perfil</h1>
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="<?php echo $volver; ?>">Volver</a>
        <h2>Mis datos</h2>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if ($error != '') { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <label>Usuario</label>
            <input type="text" value="<?php echo $_SESSION['usuario']; ?>" disabled>

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" required>

            <label>Apellido</label>
            <input type="text" name="apellido" value="<?php echo $_SESSION['apellido']; ?>" required>

            <label>Nueva contraseña</label>
            <input type="password" name="contrasena" placeholder="Dejar vacío para no cambiar">

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>

</html>
