<?php

namespace App\Clases1;

use PDO;
use PDOException;

use \App\Clases1\Conexion;

/**
 * Clase para gestionar operaciones relacionadas con productos en la base de datos.
 */
class Producto
{
    private $conexion;

    /**
     * Constructor de la clase Producto.
     */
    public function __construct()
    {
        $this->conexion = Conexion::obtenerInstancia();
    }
    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param string $nombre       Nombre del producto.
     * @param string $nombreCorto  Nombre corto del producto.
     * @param string $descripcion  Descripción del producto.
     * @param float  $pvp          Precio de venta al público del producto.
     * @param string $familia      Familia a la que pertenece el producto.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function crearProducto($nombre, $nombreCorto, $descripcion, $pvp, $familia)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "INSERT INTO productos (nombre, nombre_corto, descripcion, pvp, familia) 
                      VALUES (:nombre, :nombreCorto, :descripcion, :pvp, :familia)";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':nombreCorto', $nombreCorto);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':pvp', $pvp);
            $stmt->bindParam(':familia', $familia);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Obtiene todos los productos de la base de datos.
     *
     * @return array Retorna un array asociativo con la información de los productos.
     */
    public function obtenerProductos()
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM productos";
            $stmt = $conexion->query($query);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene un producto específico por su ID.
     *
     * @param int $id ID del producto.
     *
     * @return array|null Retorna un array asociativo con la información del producto o null si no se encuentra.
     */
    public function obtenerProductoPorID($id)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM productos WHERE id = :id";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Obtiene los códigos de los productos de una familia.
     * 
     * @param string $familia Nombre de la familia.
     * 
     * @return array Retorna un array asociativo con los nombre_corto de los productos de la fam
     */

     public function obtenerProductosPorFamilia($familia)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT nombre_corto FROM productos WHERE familia = :familia";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':familia', $familia);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo "Error: ". $e->getMessage();
            return [];
        }
    }

    /**
     * Actualiza la información de un producto en la base de datos.
     *
     * @param int    $id           ID del producto a actualizar.
     * @param string $nombre       Nuevo nombre del producto.
     * @param string $nombreCorto  Nuevo nombre corto del producto.
     * @param string $descripcion  Nueva descripción del producto.
     * @param float  $pvp          Nuevo precio de venta al público del producto.
     * @param string $familia      Nueva familia a la que pertenece el producto.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function actualizarProducto($id, $nombre, $nombreCorto, $descripcion, $pvp, $familia)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "UPDATE productos 
                      SET nombre = :nombre, nombre_corto = :nombreCorto, descripcion = :descripcion, 
                          pvp = :pvp, familia = :familia 
                      WHERE id = :id";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':nombreCorto', $nombreCorto);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':pvp', $pvp);
            $stmt->bindParam(':familia', $familia);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Elimina un producto de la base de datos por su ID.
     *
     * @param int $id ID del producto a eliminar.
     *
     * @return bool Retorna true si la operación fue exitosa, false en caso contrario.
     */
    public function eliminarProducto($id)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "DELETE FROM productos WHERE id = :id";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
