<?php

namespace App\Clases1;

use PDO;
use PDOException;
use \App\Clases1\Conexion;

/**
 * Clase para gestionar operaciones relacionadas con 
 * stocks en la base de datos.
 */

class Stock
{
    private $conexion;

    /**
     * Constructor de la clase Stock.
     */
    public function __construct()
    {
        $this->conexion = Conexion::obtenerInstancia();
    }

    /**
     * Crea un nuevo registro de stock en la base de datos.
     *
     * @param string $producto  Nombre del producto.
     * @param string $tienda    Nombre de la tienda.
     * @param int    $unidades  Cantidad de unidades en stock.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function crearStock($producto, $tienda, $unidades)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "INSERT INTO stocks (producto, tienda, unidades)
                      VALUES (:producto, :tienda, :unidades)";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':tienda', $tienda, PDO::PARAM_STR);
            $stmt->bindParam(':unidades', $unidades, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Obtiene todos los registros de stock de la base de datos.
     *
     * @return array Retorna un array asociativo con la información de los 
     * stocks.
     */
    public function obtenerStock()
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM stocks";
            $stmt = $conexion->query($query);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene el stock de un producto en una tienda.
     * 
     * @param int $producto  Código identificativo del producto.
     * @param int $tienda    Código identificativo de la tienda.
     * 
     * @return int|null Retorna el stock del producto o null si no se encuent
     */

     public function obtenerStockProductoTienda($producto, $tienda) {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT unidades FROM stocks WHERE producto = :producto AND tienda = :tienda";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_INT);
            $stmt->bindParam(':tienda', $tienda, PDO::PARAM_INT);
            $stmt->execute();
            $stock = $stmt->fetchColumn();
            return $stock;
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return null;
        }
     }

    /**
     * Obtiene los registros de stock para un producto específico.
     *
     * @param int $producto Código identificativo del producto.
     *
     * @return array|null Retorna un array asociativo con la información de los stocks o null si no se encuentran.
     */
    public function obtenerStockPorProducto($producto)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM stocks where producto = :producto";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Obtiene los registros de stock para una tienda específica.
     *
     * @param string $tienda Nombre de la tienda.
     *
     * @return array|null Retorna un array asociativo con la información de los stocks o null si no se encuentran.
     */
    public function obtenerStockPorTienda($tienda)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM stocks where tienda = :tienda";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':tienda', $tienda, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error :" . $e->getMessage();
            return null;
        }
    }

    /**
     * Actualiza la cantidad de unidades en stock para un producto y tienda específicos.
     *
     * @param string $producto Nombre del producto.
     * @param string $tienda   Nombre de la tienda.
     * @param int    $unidades Nueva cantidad de unidades en stock.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function actualizarStock($producto, $tienda, $unidades)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();

            $query = "UPDATE stocks 
                      SET unidades = :unidades 
                      WHERE producto = :producto 
                      AND tienda = :tienda";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':tienda', $tienda, PDO::PARAM_STR);
            $stmt->bindParam(':unidades', $unidades, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Elimina un registro de stock para un producto y tienda específicos.
     *
     * @param string $producto Nombre del producto.
     * @param string $tienda   Nombre de la tienda.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function eliminarStock($producto, $tienda)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "DELETE FROM stocks WHERE producto = :producto AND tienda = :tienda";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':tienda', $tienda, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
