<?php

namespace App\Clases1;

use PDO;
use PDOException;

/**
 * Clase para gestionar la conexión a la base de datos utilizando el patrón Singleton.
 */
class Conexion
{
    private static $instance;  // Instancia única de la clase.
    private $host = 'localhost';
    private $db_name = 'tarea6';
    private $username = 'gestor';
    private $password = 'secreto';
    private $conn;

    /**
     * Método privado para prevenir la creación de instancias adicionales desde fuera de la clase.
     */
    private function __construct()
    {
        // Constructor privado para prevenir la creación de instancias adicionales.
    }

    /**
     * Método estático para obtener la instancia única de la clase.
     *
     * @return Conexion Retorna la instancia única de la clase.
     */
    public static function obtenerInstancia()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Obtiene la conexión a la base de datos.
     *
     * @return PDO|null Retorna una instancia de PDO si la conexión fue exitosa, o null en caso de error.
     */
    public function obtenerConexion()
    {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En caso de error, imprime el mensaje y retorna null.
                echo "Error: " . $e->getMessage();
                return null;
            }
        }
        return $this->conn;
    }

    /**
     * Método privado para prevenir la clonación de la instancia.
     */
    private function __clone()
    {
        // Método privado para prevenir la clonación de la instancia.
    }
}
