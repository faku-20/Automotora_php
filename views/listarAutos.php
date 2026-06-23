<?php
require_once '../app/funciones.php';
protegerPagina();

$autos = obtenerAutos();
$mensaje = '';

if (isset($_GET['mensaje'])) {
    $mensaje = limpiar($_GET['mensaje']);
}

if (esAdministrador()) {
    $volver = 'principalAdministrador.php';
    $titulo = 'Listado de automoviles';
} else {
    $volver = 'principalComprador.php';
    $titulo = 'Catalogo de automoviles';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Automoviles</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
    <div class="barra">
        <h1><?php echo $titulo; ?></h1>
        <a href="../app/logout.php">Cerrar sesion</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="<?php echo $volver; ?>">Volver</a>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if (count($autos) == 0) { ?>
            <p>No hay automoviles cargados.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Anio</th>
                    <th>Color</th>
                    <th>Kilometros</th>
                    <th>Precio</th>
                    <th>Accion</th>
                </tr>

                <?php foreach ($autos as $auto) { ?>
                    <tr>
                        <td><?php echo $auto['id']; ?></td>
                        <td><?php echo $auto['marca']; ?></td>
                        <td><?php echo $auto['modelo']; ?></td>
                        <td><?php echo $auto['anio']; ?></td>
                        <td><?php echo $auto['color']; ?></td>
                        <td><?php echo $auto['kilometros']; ?></td>
                        <td>$<?php echo $auto['precio']; ?></td>
                        <td>
                            <?php if (esAdministrador()) { ?>
                                <a class="boton" href="modificarAuto.php?id=<?php echo $auto['id']; ?>">Modificar</a>
                                <a class="boton eliminar" onclick="return confirmarEliminar();" href="eliminarAuto.php?id=<?php echo $auto['id']; ?>">Eliminar</a>
                            <?php } else { ?>
                                <a class="boton" href="simularCompra.php?id=<?php echo $auto['id']; ?>">Simular compra</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>
</body>
</html>
