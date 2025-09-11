<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

// Importa las rutas de autenticación definidas en otro archivo
require __DIR__.'/AuthenticateRoute.php'; 

/** 
 * @var Router $router
 * 
 * $router es el objeto del router principal de NanoPHP.
 * Permite registrar rutas HTTP y asociarlas con controladores y métodos.
 */

// Registro de ruta principal (GET /)
// Llama al método "index" del controlador HomeController
$router->get('/', HomeController::class, 'index');
$router->post('/user/create', UserController::class, 'create');
