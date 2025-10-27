<?php

namespace App\Services;

use App\Core\helpers\HTTP;
use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use App\Config\Jwt as jwtConfig;
use App\Models\User;
use Exception;

class AuthService {

    use HTTP;

    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function authenticate(User $user): ?array
    {
        $isExistUser = $this->userRepository->findBy('username', $user->username);

        if(!$isExistUser || !password_verify($user->password, $isExistUser->password)) { 
            throw new Exception("Credenciales Invalidas.", 401);
        }

        $jwtData = jwtConfig::get();

        // ---- JWT PARA JSON ----
        $payload = [
            'sub' => $isExistUser->id,
            'username' => $isExistUser->username,
            'role' => $isExistUser->role,
            'iat' => time(),
            'exp' => time() + $jwtData['expires_in']
        ];

        $token = JWT::encode($payload, $jwtData['secret'], 'HS256');


        if($this->isJsonRequest()){
            return [
                'user' => $isExistUser,
                'token' => $token
            ];
        } else {
            session_start(); //Inicialización de la sesión
            
            // ---- SESIÓN PARA HTML ----
            $_SESSION['user'] = $isExistUser;
            $_SESSION['token'] = $token;

            return null;
        }
    }
}