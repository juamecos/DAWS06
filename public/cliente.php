<?php

// Incluimos el autoload para cargar las clases automáticamente
require_once __DIR__ . '/../vendor/autoload.php';

try {
    // Creamos un nuevo objeto SoapClient para comunicarnos con el servicio SOAP
    $cliente = new SoapClient(null, array(
        'location' => 'http://localhost/servidorSoap/servicio.php',
        'uri'      => 'http://localhost/servidorSoap',
        'trace'    => 1
    ));
} catch (SoapFault $f) {
    // Capturamos y mostramos cualquier error que ocurra durante la creación del cliente SOAP
    die("Error: ". $f->getMessage(). "\n");
}


// Llamamos a los métodos del servicio SOAP
$PVP = $cliente->__soapCall('getPVP', array('producto' => "3DSNG"));
$stock = $cliente->__soapCall('getStock', array('producto' => "ACERAX3950", 'tienda' => "CENTRAL"));
$familias = $cliente->__soapCall('getFamilias', []);
$productos = $cliente->__soapCall('getProductosFamilia', array('familia' => "CONSOL"));

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
        <h1 class="mb-4">Resultados SOAP sin WSDL</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Resultado de getPVP</h2>
                <pre><?php echo $PVP; ?></pre>
            </div>
            <div class="col-md-6">
                <h2>Resultado de getStock</h2>
                <pre><?php echo $stock; ?></pre>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h2>Resultado de getFamilias</h2>
                <?php if (!empty($familias)) : ?>
                    <ul>
                        <?php foreach ($familias as $familia) : ?>
                            <li><?php echo $familia; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No se encontraron familias.</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <h2>Resultado de getProductosFamilia</h2>
                <?php if (!empty($productos)) : ?>
                    <ul>
                        <?php foreach ($productos as $producto) : ?>
                            <li><?php echo $producto; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No se encontraron productos para la familia especificada.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

