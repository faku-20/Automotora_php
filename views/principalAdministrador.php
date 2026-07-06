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
        <a href="../app/logout.php">Cerrar sesión</a>
    </div>

    <div class="contenedor">
        <h2>Menú principal</h2>

        <div class="menu">
            <a href="cargarAuto.php">Cargar automóvil</a>
            <a href="listarAutos.php">Listar automóviles</a>
            <a href="modificarPerfil.php">Modificar perfil</a>
        </div>
    </div>
</body>

</html>