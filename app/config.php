<?php
// config.php
// Aca se cargan los datos iniciales del sistema.
// No usamos base de datos. Todo queda guardado en arreglos y sesiones.

session_start();

$usuariosIniciales = [
    'admin1' => [
        'usuario' => 'admin1',
        'contrasena' => '123456',
        'nombre' => 'Juan',
        'apellido' => 'Garcia',
        'tipo' => 'administrador'
    ],
    'admin2' => [
        'usuario' => 'admin2',
        'contrasena' => '123456',
        'nombre' => 'Maria',
        'apellido' => 'Lopez',
        'tipo' => 'administrador'
    ],
    'admin3' => [
        'usuario' => 'admin3',
        'contrasena' => '123456',
        'nombre' => 'Carlos',
        'apellido' => 'Perez',
        'tipo' => 'administrador'
    ],
    'admin4' => [
        'usuario' => 'admin4',
        'contrasena' => '123456',
        'nombre' => 'Ana',
        'apellido' => 'Martinez',
        'tipo' => 'administrador'
    ],
    'admin5' => [
        'usuario' => 'admin5',
        'contrasena' => '123456',
        'nombre' => 'Luis',
        'apellido' => 'Rodriguez',
        'tipo' => 'administrador'
    ],
    'admin6' => [
        'usuario' => 'admin6',
        'contrasena' => '123456',
        'nombre' => 'Sofia',
        'apellido' => 'Fernandez',
        'tipo' => 'administrador'
    ],
    'admin7' => [
        'usuario' => 'admin7',
        'contrasena' => '123456',
        'nombre' => 'Diego',
        'apellido' => 'Silva',
        'tipo' => 'administrador'
    ],
    'admin8' => [
        'usuario' => 'admin8',
        'contrasena' => '123456',
        'nombre' => 'Laura',
        'apellido' => 'Sosa',
        'tipo' => 'administrador'
    ],
    'admin9' => [
        'usuario' => 'admin9',
        'contrasena' => '123456',
        'nombre' => 'Pablo',
        'apellido' => 'Gomez',
        'tipo' => 'administrador'
    ],
    'admin10' => [
        'usuario' => 'admin10',
        'contrasena' => '123456',
        'nombre' => 'Valentina',
        'apellido' => 'Torres',
        'tipo' => 'administrador'
    ],
    'comprador1' => [
        'usuario' => 'comprador1',
        'contrasena' => '123456',
        'nombre' => 'Pedro',
        'apellido' => 'Mendez',
        'tipo' => 'comprador'
    ],
    'comprador2' => [
        'usuario' => 'comprador2',
        'contrasena' => '123456',
        'nombre' => 'Camila',
        'apellido' => 'Ruiz',
        'tipo' => 'comprador'
    ],
    'comprador3' => [
        'usuario' => 'comprador3',
        'contrasena' => '123456',
        'nombre' => 'Matias',
        'apellido' => 'Vega',
        'tipo' => 'comprador'
    ],
    'comprador4' => [
        'usuario' => 'comprador4',
        'contrasena' => '123456',
        'nombre' => 'Florencia',
        'apellido' => 'Castro',
        'tipo' => 'comprador'
    ],
    'comprador5' => [
        'usuario' => 'comprador5',
        'contrasena' => '123456',
        'nombre' => 'Nicolas',
        'apellido' => 'Alvarez',
        'tipo' => 'comprador'
    ],
    'comprador6' => [
        'usuario' => 'comprador6',
        'contrasena' => '123456',
        'nombre' => 'Agustina',
        'apellido' => 'Ramos',
        'tipo' => 'comprador'
    ],
    'comprador7' => [
        'usuario' => 'comprador7',
        'contrasena' => '123456',
        'nombre' => 'Santiago',
        'apellido' => 'Acosta',
        'tipo' => 'comprador'
    ],
    'comprador8' => [
        'usuario' => 'comprador8',
        'contrasena' => '123456',
        'nombre' => 'Martina',
        'apellido' => 'Diaz',
        'tipo' => 'comprador'
    ],
    'comprador9' => [
        'usuario' => 'comprador9',
        'contrasena' => '123456',
        'nombre' => 'Federico',
        'apellido' => 'Morales',
        'tipo' => 'comprador'
    ],
    'comprador10' => [
        'usuario' => 'comprador10',
        'contrasena' => '123456',
        'nombre' => 'Lucia',
        'apellido' => 'Herrera',
        'tipo' => 'comprador'
    ]
];

$autosIniciales = [
    1 => [
        'id' => 1,
        'marca' => 'Toyota',
        'modelo' => 'Corolla',
        'anio' => 2020,
        'color' => 'Blanco',
        'kilometros' => 45000,
        'precio' => 22000
    ],
    2 => [
        'id' => 2,
        'marca' => 'Volkswagen',
        'modelo' => 'Gol',
        'anio' => 2018,
        'color' => 'Gris',
        'kilometros' => 70000,
        'precio' => 14500
    ],
    3 => [
        'id' => 3,
        'marca' => 'Chevrolet',
        'modelo' => 'Onix',
        'anio' => 2021,
        'color' => 'Rojo',
        'kilometros' => 30000,
        'precio' => 17000
    ],
    4 => [
        'id' => 4,
        'marca' => 'Ford',
        'modelo' => 'Fiesta',
        'anio' => 2019,
        'color' => 'Azul',
        'kilometros' => 55000,
        'precio' => 15500
    ],
    5 => [
        'id' => 5,
        'marca' => 'Hyundai',
        'modelo' => 'HB20',
        'anio' => 2022,
        'color' => 'Negro',
        'kilometros' => 18000,
        'precio' => 19000
    ]
];

// La primera vez que se abre el sistema copiamos los datos iniciales a la sesion.
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = $usuariosIniciales;
}

if (!isset($_SESSION['autos'])) {
    $_SESSION['autos'] = $autosIniciales;
}

// Calculamos el proximo ID usando while para cumplir con las estructuras vistas en clase.
if (!isset($_SESSION['proximo_id'])) {
    $ids = array_keys($_SESSION['autos']);
    $posicion = 0;
    $mayor = 0;

    while ($posicion < count($ids)) {
        if ($ids[$posicion] > $mayor) {
            $mayor = $ids[$posicion];
        }

        $posicion++;
    }

    $_SESSION['proximo_id'] = $mayor + 1;
}
?>
