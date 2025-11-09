<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\View;

class HomeController {

    use HTTP;

    public function index(): void
    {
        if($this->isJsonRequest()){
            $this->response([
                "success" => true,
                "message" => "API NamnoPHP funcionando correctamente"
            ]);
        } else {
            View::render('Welcome');
        }
    }
}