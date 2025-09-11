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
            throw new Exception("Credenciales Invalidas.");
        }

        if($this->isJsonRequest()){
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

            return [
                'user' => $isExistUser,
                'token' => $token
            ];
        } else {
            // ---- SESIÓN PARA HTML ----
            $_SESSION['user'] = [
                'id' => $isExistUser->id,
                'name' => $isExistUser->name,
                'username' => $isExistUser->username,
                'role' => $isExistUser->role,
                'active' => $isExistUser->active
            ];

            return null;
        }
    }

    public function destroySession() {

    }
}