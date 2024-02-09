<?php

namespace App\Clases1;

use PDO;
use PDOException;

use \App\Clases1\Conexion;

/**
 * Clase para gestionar operaciones relacionadas con familias
 * en la base de datos.
 */

class Familia
{
    private $conexion;

    /**
     * Constructor de la clase Familia.
     */

    public function __construct()
    {
        $this->conexion = Conexion::obtenerInstancia();
    }
    /**
     * Método para insertar una nueva familia en la base de datos.
     * @param string $nombre Nombre de la familia.
     * @return boolean True si se creó exitosamente.
     */
    public function crearFamilia($nombre)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "INSERT INTO familias (nombre) VALUES (:nombre)";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    /**
     * Método para obtener los códigos "cod" las familias de la base de datos.
     * @return string[] Devuelve un array con las familias.
     */
    public function obtenerFamilias()
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT cod FROM familias";
            $stmt = $conexion->query($query);
            $familias = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $familias;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    /**
     * Obtiene una familia por su ID.
     *
     * @param int $id ID de la familia.
     *
     * @return array|null Retorna un array asociativo con la información de la familia o null si no se encuentra.
     */

    public function obtenerFamiliaPorId($id)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "SELECT * FROM familias WHERE id = :id";
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
     * Método para actualizar una familia en la base de datos.
     * @param int $id Id de la familia.
     * @param string $nombre Nuevo nombre de la familia.
     * @return boolean True si se actualizó correctamente, false en caso contrario.
     */

    public function actualizarFamilia($id, $nombre)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "UPDATE familias SET nombre = :nombre WHERE id = :id";

            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    /**
     * Método para eliminar una familia en la base de datos.
     * @param int $id Id de la familia.
     * @return boolean True si se eliminó correctamente, false en caso contrario.
     */
    public function eliminarFamilia($id)
    {
        try {
            $conexion = $this->conexion->obtenerConexion();
            $query = "DELETE FROM familias WHERE id = :id";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();

            return false;
        }
    }

}