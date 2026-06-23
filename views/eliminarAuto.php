<?php
require_once '../app/funciones.php';
protegerAdministrador();

$id = 0;
$error = '';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

$auto = obtenerAutoPorId($id);

if ($auto == null) {
    $error = 'No se encontro el automovil.';
} else {
    eliminarAuto($id);
    header('Location: listarAutos.php?mensaje=Automovil%20eliminado%20correctamente');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar automovil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="barra">
        <h1>Eliminar automovil</h1>
        <a href="../app/logout.php">Cerrar sesion</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="listarAutos.php">Volver</a>
        <p class="error"><?php echo $error; ?></p>
    </div>
</body>
</html>
