<?php

require_once __DIR__ . '/../vendor/autoload.php';


// Ruta de la clase que contiene las funciones del servicio SOAP
$class = "App\Clases1\\Operaciones";
// URI del servicio
$uri = 'http://localhost/servidorSoap/servicioW.php';
try {
    // Crear generador de WSDL
    $wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $uri);
    if($wsdlGenerator) {
       print_r('el generador existe');
    } 
    // Generar el WSDL
    // Hemos comprobado que el generador existe, en cambio, generateWSDL(true) parece que genera una Excepción error, por lo que generamos el WSDL manualmente
    $wsdlGenerator->generateWSDL(true);
    // Guardar el archivo WSDL en la carpeta del servidor SOAP
    $fichero = $wsdlGenerator->save('../servidorSoap/servicio2.wsdl');
    echo "WSDL generado con éxito." . PHP_EOL;
} catch (Exception $e) {
    echo "Error al generar el WSDL: " . $e->getMessage() . PHP_EOL;
}
