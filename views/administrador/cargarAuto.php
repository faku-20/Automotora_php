<?php
require_once '../../app/funciones.php';
protegerAdministrador();

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        agregarAuto($marca, $modelo, $anio, $color, $kilometros, $precio);
        $mensaje = 'Automóvil cargado correctamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cargar automóvil</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="barra">
        <h1>Cargar automóvil</h1>
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="principal.php">Volver</a>
        <h2>Datos del automóvil</h2>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if ($error != '') { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST">
            <label>Marca</label>
            <input type="text" name="marca" required>

            <label>Modelo</label>
            <input type="text" name="modelo" required>

            <label>Año</label>
            <input type="number" name="anio" min="1900" required>

            <label>Color</label>
            <input type="text" name="color" required>

            <label>Kilómetros</label>
            <input type="number" name="kilometros" min="0" required>

            <label>Precio</label>
            <input type="number" name="precio" min="0" step="0.01" required>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>

</html>
