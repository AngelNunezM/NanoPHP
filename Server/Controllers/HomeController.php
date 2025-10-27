<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Core\View;

class HomeController {

    use HTTP;

    public function index(): void
    {
        Authentication::verify();
        
        if($this->isJsonRequest()){
            $this->response([
                "success" => true,
                "message" => "API nanoPHP v1.07.2 Alpha"
            ]);
        } else {
            View::render('Dashboard');
        }
    }
}