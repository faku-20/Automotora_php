<?php
require_once '../app/funciones.php';
protegerComprador();

$id = 0;
$entrega = 0;
$cuotas = 0;
$mensaje = '';
$error = '';

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
}

if (isset($_POST['entrega'])) {
    $entrega = $_POST['entrega'];
}

if (isset($_POST['cuotas'])) {
    $cuotas = $_POST['cuotas'];
}

$auto = obtenerAutoPorId($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])) {
    $nombre = limpiar($_POST['nombre']);
    $telefono = limpiar($_POST['telefono']);
    $comentario = limpiar($_POST['comentario']);

    if (campoVacio($nombre) || campoVacio($telefono)) {
        $error = 'Debe completar nombre y teléfono.';
    } else {
        $mensaje = 'Solicitud enviada. Un vendedor se comunicará contigo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contactar vendedor</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="barra">
        <h1>Contactar vendedor</h1>
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="listarAutos.php">Volver al catálogo</a>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if ($error != '') { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <?php if ($auto == null) { ?>
            <p class="error">No se recibieron datos de la simulación.</p>
        <?php } else { ?>
            <h2>Resumen</h2>
            <p><strong>Automóvil:</strong> <?php echo $auto['marca'] . ' ' . $auto['modelo']; ?></p>
            <p><strong>Entrega:</strong> $<?php echo $entrega; ?></p>
            <p><strong>Cuotas:</strong> <?php echo $cuotas; ?></p>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="entrega" value="<?php echo $entrega; ?>">
                <input type="hidden" name="cuotas" value="<?php echo $cuotas; ?>">

                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" required>

                <label>Teléfono</label>
                <input type="text" name="telefono" required>

                <label>Comentario</label>
                <textarea name="comentario" rows="4"></textarea>

                <button type="submit" name="enviar">Enviar solicitud</button>
            </form>
        <?php } ?>
    </div>
</body>

</html>