<?php

// Incluimos el autoload para cargar las clases automáticamente
require_once __DIR__ . '/../vendor/autoload.php';


// Creamos el servidor SOAP con los parámetros necesarios
$parametros = array('uri' => 'http://localhost/servidorSoap');
try {
    // Creamos una instancia de SoapServer con los parámetros dados
    $server = new SoapServer(null, $parametros);

    // Configuramos la clase que manejará las solicitudes SOAP
    $server->setClass('App\Clases1\Operaciones');

    // Manejamos las solicitudes SOAP recibidas
    $server->handle();
} catch (SoapFault $f) {
    // Capturamos cualquier error que ocurra durante la ejecución del servidor SOAP
    die("Error en servidor: " . $f->getMessage() . "\n");
}


