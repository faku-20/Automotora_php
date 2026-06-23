<?php
require_once '../app/funciones.php';
protegerAdministrador();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel administrador</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="barra">
        <h1>Panel administrador</h1>
        <p><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></p>
        <a href="../app/logout.php">Cerrar sesion</a>
    </div>

    <div class="contenedor">
        <h2>Menu principal</h2>

        <div class="menu">
            <a href="cargarAuto.php">Cargar automovil</a>
            <a href="listarAutos.php">Listar automoviles</a>
            <a href="modificarPerfil.php">Modificar perfil</a>
        </div>
    </div>
</body>
</html>
