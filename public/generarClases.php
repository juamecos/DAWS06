<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Wsdl2PhpGenerator\Generator;
use Wsdl2PhpGenerator\Config;

try {
    // Configuración para la generación de la clase PHP
    $config = new Config([
        'inputFile' => '../servidorSoap/servicio.wsdl', // Ruta al archivo WSDL
        'outputDir' => '../src/Clases1', // Directorio de salida para la clase generada
    ]);

    // Generar la clase PHP
    $generator = new Generator();
    $generator->generate($config);


    echo "Clase PHP generada con éxito." . PHP_EOL;
} catch (Exception $e) {
    echo "Error al generar la clase PHP: " . $e->getMessage() . PHP_EOL;
}
