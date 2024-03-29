<?php

class AppClases1OperacionesService extends \SoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(), $wsdl = null)
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      if (!$wsdl) {
        $wsdl = '../servidorSoap/servicio.wsdl';
      }
      parent::__construct($wsdl, $options);
    }

    /**
     * @param string $producto
     * @return float
     */
    public function getPVP($producto)
    {
      return $this->__soapCall('getPVP', array('producto' => $producto));
    }

    /**
     * Método para obtener el stock de un producto en una tienda.
     *
     * @param string $producto
     * @param string $tienda
     * @return int
     */
    public function getStock($producto, $tienda)
    {
      return $this->__soapCall('getStock', array('producto' => $producto, 'tienda' => $tienda));
    }

    /**
     * Método para obtener los códigos de todas las familias existentes.
     *
     * @return array
     */
    public function getFamilias()
    {
      return $this->__soapCall('getFamilias', array());
    }

    /**
     * Método para obtener los códigos de todos los productos de una familia.
     *
     * @param string $familia
     * @return array
     */
    public function getProductosFamilia($familia)
    {
      return $this->__soapCall('getProductosFamilia', array($familia));
    }

}
