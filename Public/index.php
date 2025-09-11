<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router; // Importación del Router.php

$router = new Router(); // Instancia del router

// Importamos todas las rutas que se encuentran en web.php : todas las rutas englobadas
require __DIR__ . '/../Server/Routes/web.php';

// Despachamos la ruta actual para retornar la solicitud del cliente
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
