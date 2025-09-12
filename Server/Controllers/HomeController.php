<?php

namespace App\Controllers;

use App\Core\Middlewares\Authentication;
use App\Core\View;

class HomeController {
    public function index(): void
    {
        Authentication::verify();

        View::render('Dashboard');
    }
}