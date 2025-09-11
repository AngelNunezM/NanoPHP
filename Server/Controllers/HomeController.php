<?php

namespace App\Controllers;

use App\Core\Middlewares\AuthMiddleware;
use App\Core\View;

class HomeController {
    public function index(): void
    {
        AuthMiddleware::verify();

        View::render('Dashboard');
    }
}