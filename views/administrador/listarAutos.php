<?php
require_once '../../app/funciones.php';
protegerPagina();

$autos = obtenerAutos();
$mensaje = '';

if (isset($_GET['mensaje'])) {
    $mensaje = limpiar($_GET['mensaje']);
}

if (esAdministrador()) {
    $volver = 'principal.php';
    $titulo = 'Listado de automóviles';
} else {
    $volver = '../comprador/principal.php';
    $titulo = 'Catálogo de automóviles';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Automóviles</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <script src="../../public/js/script.js"></script>
</head>

<body>
    <div class="barra">
        <h1><?php echo $titulo; ?></h1>
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="<?php echo $volver; ?>">Volver</a>

        <?php if ($mensaje != '') { ?>
            <p class="ok"><?php echo $mensaje; ?></p>
        <?php } ?>

        <?php if (count($autos) == 0) { ?>
            <p>No hay automóviles cargados.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Color</th>
                    <th>Kilómetros</th>
                    <th>Precio</th>
                    <th>Acción</th>
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
