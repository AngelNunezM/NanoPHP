<?php

namespace App\Routes;

use App\Core\Router;
use App\Controllers\AuthController;

/** @var Router $router */

$router->get('/login', AuthController::class, 'index');
$router->post('/login', AuthController::class, 'login');
$router->post('/logout', AuthController::class, 'logout');

