<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Services\AuthService;
use App\Models\User;
use App\Core\View;
use Exception;

class AuthController {
    
    use HTTP; // Trait para preparar las request
    
    private AuthService $authService; // Propiedad para acceder al servicio de auth y sus funciones

    public function __construct() {
        $this->authService = new AuthService(); // Instancia directa del servicio
        session_start(); //Inicialización de la sesión
    }

    public function index(): void
    {
        if(!empty($_SESSION['user'])){
            $this->redirect('/');
        }
        View::render('auth/Login');
    }

    public function login() : void 
    {
        $request = $this->request();
        var_dump($request);
        try {
            $user = new User();
            $user->username = $request['username'];
            $user->password = $request['password'];

            $authResult = $this->authService->authenticate($user);

            if ($this->isJsonRequest()) {
                $this->response([
                    'success' => true,
                    'token' => $authResult['token'],
                    'user' => $authResult['user']
                ]);
            } else {
                $this->redirect('/');
            }

        } catch (Exception $ex) {
            // Respuesta según tipo de request
            if ($this->isJsonRequest()) {
                $this->response([
                    'success' => false,
                    "message" => $ex->getMessage()
                ], 401);
            } else {
                View::render('auth/Login', ['error' => $ex->getMessage()]);
            }
        }
    }

    public function logout() : void 
    {
        session_destroy();
        $this->redirect('/login');
    }
}