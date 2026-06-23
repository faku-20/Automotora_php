<?php
require_once '../app/funciones.php';
protegerComprador();

$id = 0;
$error = '';
$resultado = false;
$entrega = 0;
$cuotas = 12;
$saldo = 0;
$valorCuota = 0;

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
}

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
}

$auto = obtenerAutoPorId($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $auto != null) {
    $entrega = $_POST['entrega'];
    $cuotas = $_POST['cuotas'];

    if (!numeroValido($entrega) || !numeroValido($cuotas)) {
        $error = 'Los datos deben ser numericos.';
    } else if ($entrega >= $auto['precio']) {
        $error = 'La entrega inicial debe ser menor al precio del automovil.';
    } else if ($cuotas <= 0) {
        $error = 'La cantidad de cuotas debe ser mayor a cero.';
    } else {
        $saldo = $auto['precio'] - $entrega;
        $valorCuota = $saldo / $cuotas;
        $resultado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Simular compra</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="barra">
        <h1>Simular compra</h1>
        <a href="../app/logout.php">Cerrar sesion</a>
    </div>

    <div class="contenedor">
        <a class="volver" href="listarAutos.php">Volver</a>

        <?php if ($auto == null) { ?>
            <p class="error">Debe elegir un automovil del catalogo.</p>
        <?php } else { ?>
            <h2><?php echo $auto['marca'] . ' ' . $auto['modelo']; ?></h2>
            <p><strong>Precio:</strong> $<?php echo $auto['precio']; ?></p>

            <?php if ($error != '') { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $auto['id']; ?>">

                <label>Entrega inicial</label>
                <input type="number" name="entrega" min="0" step="0.01" value="<?php echo $entrega; ?>" required>

                <label>Cantidad de cuotas</label>
                <select name="cuotas">
                    <?php for ($i = 1; $i <= 60; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php if ($i == $cuotas) { echo 'selected'; } ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit">Calcular</button>
            </form>

            <?php if ($resultado == true) { ?>
                <div class="resultado">
                    <h3>Resultado de la simulacion</h3>
                    <p>Precio del automovil: $<?php echo $auto['precio']; ?></p>
                    <p>Entrega inicial: $<?php echo $entrega; ?></p>
                    <p>Saldo restante: $<?php echo $saldo; ?></p>
                    <p>Cantidad de cuotas: <?php echo $cuotas; ?></p>
                    <p><strong>Valor de cada cuota: $<?php echo round($valorCuota, 2); ?></strong></p>

                    <form method="POST" action="contactarVendedor.php">
                        <input type="hidden" name="id" value="<?php echo $auto['id']; ?>">
                        <input type="hidden" name="entrega" value="<?php echo $entrega; ?>">
                        <input type="hidden" name="cuotas" value="<?php echo $cuotas; ?>">
                        <button type="submit">Contactar vendedor</button>
                    </form>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>
