<?php
require_once '../../app/funciones.php';
protegerAdministrador();

$id = 0;
$mensaje = '';
$error = '';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
}

$auto = obtenerAutoPorId($id);

if ($auto == null) {
    $error = 'No se encontró el automóvil.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $auto != null) {
    $marca = limpiar($_POST['marca']);
    $modelo = limpiar($_POST['modelo']);
    $anio = limpiar($_POST['anio']);
    $color = limpiar($_POST['color']);
    $kilometros = limpiar($_POST['kilometros']);
    $precio = limpiar($_POST['precio']);

    if (campoVacio($marca) || campoVacio($modelo) || campoVacio($anio) || campoVacio($color) || campoVacio($kilometros) || campoVacio($precio)) {
        $error = 'Debe completar todos los campos.';
    } else if (!numeroValido($anio) || !numeroValido($kilometros) || !numeroValido($precio)) {
        $error = 'Año, kilómetros y precio deben ser números.';
    } else {
        modificarAuto($id, $marca, $modelo, $anio, $color, $kilometros, $precio);
        $auto = obtenerAutoPorId($id);
        $mensaje = 'Automóvil modificado correctamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar automóvil</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="barra">
        <h1>Modificar automóvil</h1>
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="listarAutos.php">Volver</a>
        <h2>Editar datos</h2>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if ($error != '') { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <?php if ($auto != null) { ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $auto['id']; ?>">

                <label>Marca</label>
                <input type="text" name="marca" value="<?php echo $auto['marca']; ?>" required>

                <label>Modelo</label>
                <input type="text" name="modelo" value="<?php echo $auto['modelo']; ?>" required>

                <label>Año</label>
                <input type="number" name="anio" value="<?php echo $auto['anio']; ?>" min="1900" required>

                <label>Color</label>
                <input type="text" name="color" value="<?php echo $auto['color']; ?>" required>

                <label>Kilómetros</label>
                <input type="number" name="kilometros" value="<?php echo $auto['kilometros']; ?>" min="0" required>

                <label>Precio</label>
                <input type="number" name="precio" value="<?php echo $auto['precio']; ?>" min="0" step="0.01" required>

                <button type="submit">Guardar cambios</button>
            </form>
        <?php } ?>
    </div>
</body>

</html>
