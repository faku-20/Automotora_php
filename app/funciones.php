<?php
require_once __DIR__ . '/config.php';

// Limpia espacios y evita que se escriba HTML raro en pantalla.
function limpiar($texto)
{
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

function estaLogueado()
{
    if (isset($_SESSION['usuario'])) {
        return true;
    }

    return false;
}

function esAdministrador()
{
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'administrador') {
        return true;
    }

    return false;
}

function esComprador()
{
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'comprador') {
        return true;
    }

    return false;
}

function protegerPagina()
{
    if (!estaLogueado()) {
        header('Location: ../index.php?error=Debe%20iniciar%20sesión');
        exit();
    }
}

function protegerAdministrador()
{
    protegerPagina();

    if (!esAdministrador()) {
        header('Location: ../index.php?error=No%20tiene%20permiso');
        exit();
    }
}

function protegerComprador()
{
    protegerPagina();

    if (!esComprador()) {
        header('Location: ../index.php?error=No%20tiene%20permiso');
        exit();
    }
}

function validarLogin($usuario, $contrasena)
{
    if (isset($_SESSION['usuarios'][$usuario])) {
        if ($_SESSION['usuarios'][$usuario]['contrasena'] == $contrasena) {
            return true;
        }
    }

    return false;
}

function obtenerUsuario($usuario)
{
    if (isset($_SESSION['usuarios'][$usuario])) {
        return $_SESSION['usuarios'][$usuario];
    }

    return null;
}

function modificarUsuarioActual($nombre, $apellido, $contrasenaNueva)
{
    $usuario = $_SESSION['usuario'];

    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellido'] = $apellido;

    $_SESSION['usuarios'][$usuario]['nombre'] = $nombre;
    $_SESSION['usuarios'][$usuario]['apellido'] = $apellido;

    if ($contrasenaNueva != '') {
        $_SESSION['usuarios'][$usuario]['contrasena'] = $contrasenaNueva;
    }
}

function obtenerAutos()
{
    return $_SESSION['autos'];
}

function obtenerAutoPorId($id)
{
    if (isset($_SESSION['autos'][$id])) {
        return $_SESSION['autos'][$id];
    }

    return null;
}

function agregarAuto($marca, $modelo, $anio, $color, $kilometros, $precio)
{
    $id = $_SESSION['proximo_id'];

    $_SESSION['autos'][$id] = [
        'id' => $id,
        'marca' => $marca,
        'modelo' => $modelo,
        'anio' => $anio,
        'color' => $color,
        'kilometros' => $kilometros,
        'precio' => $precio
    ];

    $_SESSION['proximo_id'] = $_SESSION['proximo_id'] + 1;
}

function modificarAuto($id, $marca, $modelo, $anio, $color, $kilometros, $precio)
{
    if (isset($_SESSION['autos'][$id])) {
        $_SESSION['autos'][$id]['marca'] = $marca;
        $_SESSION['autos'][$id]['modelo'] = $modelo;
        $_SESSION['autos'][$id]['anio'] = $anio;
        $_SESSION['autos'][$id]['color'] = $color;
        $_SESSION['autos'][$id]['kilometros'] = $kilometros;
        $_SESSION['autos'][$id]['precio'] = $precio;

        return true;
    }

    return false;
}

function eliminarAuto($id)
{
    if (isset($_SESSION['autos'][$id])) {
        unset($_SESSION['autos'][$id]);
        return true;
    }

    return false;
}

function campoVacio($valor)
{
    if (trim($valor) == '') {
        return true;
    }

    return false;
}

function numeroValido($valor)
{
    if (is_numeric($valor) && $valor >= 0) {
        return true;
    }

    return false;
}
