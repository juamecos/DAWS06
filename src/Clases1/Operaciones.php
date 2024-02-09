<?php

namespace App\Clases1;

use PDO;
use PDOException;

use \App\Clases1\Producto;
use \App\Clases1\Familia;
use \App\Clases1\Stock;


class Operaciones
{
    private $producto;
    private $familia;
    private $stock;

    public function __construct()
    {
        $this->producto = new Producto();
        $this->familia = new Familia();
        $this->stock = new Stock();
    }

    /**
     * @soap
     * 
     * @param int $producto id de producto
     * 
     * @return float|null Precio de venta al público del producto.
     */
    public function getPVP($producto)
    {
        try {
            $productoInfo = $this->producto->obtenerProductoPorID($producto);
            return $productoInfo['pvp'];

        } catch(PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Método para obtener el stock de un producto en una tienda.
     * @soap
     * 
     * @param int $producto ID del producto.
     * @param int $tienda   ID de la tienda.
     * 
     * @return int|null Retorna el stock del producto o null si no se encuentra.
     */

    public function getStock($producto, $tienda)
    {
        try {
            $stockInfo = $this->stock->obtenerStockProductoTienda($producto, $tienda);

            return $stockInfo ? $stockInfo : null;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Método para obtener los códigos de todas las familias existentes.
     * @soap
     * 
     * 
     * @return array Retorna un array con los códigos de todas las familias existentes.
     */
    public function getFamilias()
    {
        try {
            $familias = $this->familia->obtenerFamilias();

            return $familias ? $familias : [];
        } catch (PDOException $e) {
            error_log('' . $e->getMessage());
            return []; // Retornar un array vacío en caso de error
        }
    }

    /**
     * Método para obtener los códigos de todos los productos de una familia.
     * 
     * @soap
     * 
     * @param string $familia Nombre de la familia.
     * 
     * @return array Retorna un array con los codigos de los productos de una familia
     */

    public function getProductosFamilia($familia)
    {
        try {
            $productos = $this->producto->obtenerProductosPorFamilia($familia);

            return $productos ? $productos : [];
        } catch (PDOException $e) {
            error_log('' . $e->getMessage());
            return []; // Retornar un array vacío en caso de error
        }
    }
}