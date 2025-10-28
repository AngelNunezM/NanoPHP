<?php

use App\Core\Router;
use App\Controllers\HomeController;

// ---------------------------------------------------------------------
// Importación de módulos de rutas
// ---------------------------------------------------------------------
/**
 * En este archivo central (`web.php`) se definen las rutas principales de
 * la aplicación. Para mantener una arquitectura modular, las rutas más
 * específicas (como autenticación o proyectos) se importan desde otros
 * archivos separados:
 * 
 *  - AuthenticateRoute.php -> Maneja rutas relacionadas con login, registro, etc.
 *  - ProjectRoute.php      -> Maneja rutas relacionadas con proyectos.
 */

require __DIR__ . '/UserRoute.php'; 
require __DIR__ . '/AuthenticateRoute.php'; 

// ---------------------------------------------------------------------
// Tipado y referencia del router
// ---------------------------------------------------------------------
/**
 * @var Router $router
 * 
 * $router es el objeto del router principal de la aplicación.
 * Este permite:
 *   - Registrar rutas HTTP (GET, POST, PUT, DELETE, etc.).
 *   - Asociar cada ruta con un controlador y un método específico.
 *   - Resolver la solicitud actual en base a la URI y método HTTP.
 */

// ---------------------------------------------------------------------
// Definición de rutas principales
// ---------------------------------------------------------------------

/**
 * Ruta principal de la aplicación
 * 
 * Método: GET
 * URI:    /
 * Acción: HomeController@index
 * 
 * Cuando un usuario accede a la raíz del sitio (ej. http://localhost/),
 * se ejecuta el método "index" del controlador HomeController.
 */
$router->get('/', HomeController::class, 'index');
