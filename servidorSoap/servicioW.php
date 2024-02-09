<?php

// Incluimos el autoload para cargar las clases automáticamente
require_once __DIR__ . '/../vendor/autoload.php';

// Definimos la ubicación del archivo WSDL y el URI del servicio
$wsdl= "http://localhost/servidorSoap/servicio.wsdl";
$uri = "http://localhost/servidorSoap"; 

// Creamos el servidor SOAP con los parámetros necesarios, incluyendo la desactivación de la caché del WSDL
$parametros = array('uri' => $uri, 'cache_wsdl' => WSDL_CACHE_NONE);

try {
    // Intentamos crear el servidor SOAP utilizando el archivo WSDL y los parámetros definidos
    $server = new SoapServer($wsdl, $parametros);
    
    // Establecemos la clase que contiene las funciones del servicio SOAP
    $server->setClass('App\Clases1\Operaciones');
    
    // Manejamos las solicitudes entrantes al servidor SOAP
    $server->handle();
} catch (SoapFault $f) {
    // Capturamos y mostramos cualquier error que ocurra durante la creación o manejo del servidor SOAP
    die("Error en servidor: " . $f->getMessage() . "\n");
}

