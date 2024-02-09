<?php

try {
    // Intentamos crear un cliente SOAP utilizando el archivo WSDL especificado y los parámetros definidos
    $cliente = new SoapClient('http://localhost/servidorSoap/servicio.wsdl', array(
        'location' => 'http://localhost/servidorSoap/servicioW.php', // Especificamos la ubicación del servicio
        'uri' => 'http://localhost/servidorSoap', // Definimos el URI del servicio
        'trace' => 1, // Habilitamos el seguimiento de trazas para depuración
        'cache_wsdl' => WSDL_CACHE_NONE // Desactivamos la caché del WSDL para evitar problemas de actualización
    )
    );
} catch (SoapFault $f) {
    // Capturamos y manejamos cualquier error que ocurra durante la creación del cliente SOAP
    die("Error: " . $f->getMessage() . "\n");
}

// Llamamos a los métodos del servicio SOAP
$PVP = $cliente->__soapCall('getPVP', array('producto' => 1));
$stock = $cliente->__soapCall('getStock', array('producto' => 1, 'tienda' => 1));
$familias = $cliente->__soapCall('getFamilias', []);
$productos = $cliente->__soapCall('getProductosFamilia', array('familia' => "CAMARA"));

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

</html>