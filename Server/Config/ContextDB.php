<?php

namespace App\Config;

use PDO;
use PDOException;

/**
 * Class ContextDB
 * 
 * Esta clase se encarga de manejar la **conexión a la base de datos** usando PDO.
 * Permite conectarse tanto en entornos locales como de producción, 
 * estableciendo automáticamente las credenciales según el host.
 * 
 * Uso típico:
 * ```php
 * $db = new ContextDB();
 * $conn = $db->conn; // Objeto PDO listo para usar
 * ```
 */
class ContextDB
{
    /**
     * @var PDO Objeto PDO que se usa para ejecutar consultas
     */
    public PDO $conn;

    /**
     * @var string Host de la base de datos
     */
    private string $host = "localhost";

    /**
     * @var string Nombre de la base de datos
     */
    private string $dbname = "example";

    /**
     * @var string Usuario de la base de datos
     */
    private string $username = "root";

    /**
     * @var string Contraseña de la base de datos
     */
    private string $password = "";

    /**
     * Constructor
     * 
     * Configura el entorno (local o producción) y establece la conexión PDO
     */
    public function __construct()
    {
        $this->setEnvironment();
        $this->connect(); // Inicializa el objeto PDO y lo asigna a $conn
    }

    /**
     * Configura las credenciales según el entorno
     * 
     * Detecta si se está en entorno local o producción y ajusta
     * host, usuario y contraseña en consecuencia.
     */
    private function setEnvironment(): void
    {
        $localHosts = ['localhost', '127.0.0.1'];
        $currentHost = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';

        if (in_array($currentHost, $localHosts) || str_contains($currentHost, '.local') || str_contains($currentHost, 'localhost')) {
            // Local
            $this->host = 'localhost';
            $this->username = 'root';
            $this->password = '';
        } else {
            // Producción
            $this->host = 'localhost';
            $this->username = '';
            $this->password = '';
        }
    }

    /**
     * Inicializa la conexión PDO
     * 
     * Configura los atributos principales de PDO:
     * - ERRMODE_EXCEPTION para manejo de errores
     * - FETCH_ASSOC como modo de fetch por defecto
     * - DESACTIVA emulación de prepares
     * 
     * En caso de error, termina la ejecución con un mensaje JSON.
     */
    private function connect(): void
    {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Error de conexión: ' . $e->getMessage()
            ]));
        }
    }
}
