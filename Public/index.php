<?php
header("Access-Control-Allow-Origin: *"); // Permite todos los orígenes
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

/**
 * Punto de entrada principal de la aplicación.
 * 
 * Este archivo se encarga de:
 *  1. Cargar el autoload de Composer.
 *  2. Inicializar las variables de entorno (.env).
 *  3. Crear la instancia del Router principal.
 *  4. Importar y registrar todas las rutas definidas en el proyecto.
 *  5. Despachar la solicitud actual del cliente (HTTP Request).
 */

require __DIR__ . '/../vendor/autoload.php'; // Autoload de Composer

use Dotenv\Dotenv;
use App\Core\Router; // Importación del Router personalizado

// ---------------------------------------------------------------------
// 1. Carga de variables de entorno (.env)
// ---------------------------------------------------------------------
/**
 * Usamos la librería vlucas/phpdotenv para cargar las variables de entorno 
 * definidas en el archivo `.env`. Esto permite manejar configuraciones 
 * sensibles como credenciales de base de datos, llaves secretas, etc.
 * 
 * dirname(__DIR__) -> nos regresa el directorio raíz del proyecto
 */
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// ---------------------------------------------------------------------
// 2. Inicialización del Router
// ---------------------------------------------------------------------
/**
 * El Router es el encargado de asociar cada ruta (URI + método HTTP)
 * con un controlador y una acción correspondiente.
 */
$router = new Router();

// ---------------------------------------------------------------------
// 3. Importación de las rutas definidas en el proyecto
// ---------------------------------------------------------------------
/**
 * web.php contiene todas las rutas del sistema agrupadas.
 * Aquí solo se importan para que el Router pueda registrarlas.
 */
require __DIR__ . '/../Server/Routes/web.php';

// ---------------------------------------------------------------------
// 4. Despacho de la solicitud HTTP actual
// ---------------------------------------------------------------------
/**
 * Se toma la URI solicitada por el cliente ($_SERVER['REQUEST_URI'])
 * y el método HTTP ($_SERVER['REQUEST_METHOD']) para determinar qué 
 * controlador y método ejecutar.
 * 
 * Ejemplo:
 *   - GET /usuarios -> UsersController@index
 *   - POST /usuarios -> UsersController@store
 */
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
