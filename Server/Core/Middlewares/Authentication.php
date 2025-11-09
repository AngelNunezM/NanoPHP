<?php

namespace App\Core\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config\Jwt as jwtConfig;
use App\Core\View;
use App\Models\User;
use App\Services\UserService;
use Exception;

class Authentication
{
    public static ?User $user = null;

    public static function verify(array $roles = []): ?bool
    {
        $config = jwtConfig::get();
        $userService = new UserService(); 
        

        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $isJsonRequest = stripos($accept, 'application/json') !== false
                      || stripos($contentType, 'application/json') !== false;

        if (!$isJsonRequest) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['user'])) {
                self::$user = $userService->getUserById($_SESSION['user']->id);

                if (!self::$user->isActive) {
                    self::deny("Tu cuenta está inactiva", 401);
                }

                if (!empty($roles) && !in_array(self::$user->role->name, $roles)) {
                    self::deny("No tienes permiso para acceder a este recurso", 403);
                }
                return true;
            }
        }

        $headers = getallheaders();
        $token = $headers['Authorization']
            ?? $_SERVER['HTTP_AUTHORIZATION']
            ?? $_SERVER['REDIRECT_HTTP_AUTHORIZATION']
            ?? null;

        if ($token) {
            try {
                if (str_starts_with($token, 'Bearer ')) {
                    $token = substr($token, 7);
                }

                $decoded = JWT::decode($token, new Key($config['secret'], 'HS256'));
                $user = $userService->getUserById($decoded->sub);

                self::$user = $user;

                if (!self::$user->isActive) {
                    self::deny("Tu cuenta está inactiva", 401);
                }

                // 🔹 Si es web, guarda en sesión para mantener autenticación
                if (!$isJsonRequest) {
                    $_SESSION['user'] = self::$user;
                }

                // 🔹 Verificar roles
                if (!empty($roles) && !in_array(self::$user->role->name, $roles)) {
                    self::deny("No tienes permiso para acceder a este recurso", 403);
                }

                return true;
            } catch (\Exception $e) {
                self::deny("Token inválido o expirado", 401);
            }
        }

        self::deny("No te encuentras autenticado.", 401);
        return false;
    }

    public static function user(): ?User
    {
        return self::$user ?? null;
    }

    private static function deny(string $message, int $status): void
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
        $isJsonRequest = stripos($contentType, 'application/json') !== false
                        || stripos($accept, 'application/json') !== false;

        http_response_code($status);

        if ($isJsonRequest) {
            echo json_encode([
                'success' => false,
                'message' => $message
            ]);
        } else {
            if ($status === 401) {
                View::render('auth/Login', ['error' => $message]);
            } elseif ($status === 403) {
                header("Location: /");
            }
        }

        exit;
    }
}
