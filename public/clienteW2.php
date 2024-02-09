<?php

require_once '../src/Clases1/autoload.php';

$cliente = new \AppClases1OperacionesService();

// Llamamos a los métodos del servicio SOAP
$PVP = $cliente->getPVP(1);
$stock = $cliente->getStock(1, 1);
$familias = $cliente->getFamilias();
$productos = $cliente->getProductosFamilia('CAMARA')

// Imprimimos los resultados de las llamadas
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Results</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-3">
        <h1>Resultados SOAP con WSDL</h1>
        <h2>Resultado de getPVP</h2>
        <pre><?php print_r($PVP); ?></pre>
        <hr>
        <h2>Resultado de getStock</h2>
        <pre><?php print_r($stock); ?></pre>
        <hr>
        <h2>Resultado de getFamilias</h2>
        <pre><?php print_r($familias); ?></pre>
        <hr>
        <h2>Resultado de getProductosFamilia</h2>
        <pre><?php print_r($productos); ?></pre>
    </div>
</body>