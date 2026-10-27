<?php
require_once '../../app/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = limpiar($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    if ($usuario == '' || $contrasena == '') {
        header('Location: ../../index.php?error=Complete%20todos%20los%20campos');
        exit();
    }

    if (validarLogin($usuario, $contrasena)) {
        $datos = obtenerUsuario($usuario);

        $_SESSION['usuario'] = $datos['usuario'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['apellido'] = $datos['apellido'];
        $_SESSION['tipo'] = $datos['tipo'];

        if ($datos['tipo'] == 'administrador') {
            header('Location: ../administrador/principal.php');
            exit();
        } else {
            header('Location: ../comprador/principal.php');
            exit();
        }
    } else {
        header('Location: ../index.php?error=Usuario%20o%20contraseña%20incorrectos');
        exit();
    }
} else {
    header('Location: ../../index.php');
    exit();
}
