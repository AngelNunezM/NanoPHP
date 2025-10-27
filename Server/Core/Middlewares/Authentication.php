<?php

namespace App\Core\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config\Jwt as jwtConfig;
use App\Core\View;
use App\Models\User;

/**
 * Class Authentication
 *
 * Middleware para proteger rutas verificando la autenticación y autorización del usuario.
 * 
 * Este middleware verifica:
 * 1. Si existe una sesión activa de usuario.
 * 2. Si existe un token JWT válido en la cabecera Authorization.
 * 3. Si el usuario tiene los roles requeridos (opcional).
 *
 * Uso:
 * Colocar `Authentication::verify(['Rol1', 'Rol2'])` al inicio de un método de controlador o ruta protegida.
 *
 * Ejemplos:
 * - Authentication::verify(); // Solo verifica autenticación
 * - Authentication::verify(['Administrador']); // Verifica autenticación y rol específico
 */
class Authentication
{

    public static ?User $user = null;

    public static function verify(array $roles = []): ?bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $config = jwtConfig::get();

        if (isset($_SESSION['user'])) {
            self::$user = $_SESSION['user'];

            if (!empty($roles) && !in_array(self::$user->role->name, $roles)) {
                self::deny("No tienes permiso para acceder a este recurso", 403);
            }
            return true;
        }

        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;

        if ($token) {
            try {
                if (str_starts_with($token, 'Bearer ')) {
                    $token = substr($token, 7);
                }

                $decoded = JWT::decode($token, new Key($config['secret'], 'HS256'));

                self::$user = new User([
                    'id' => $decoded->sub,
                    'username' => $decoded->username,
                    'role' => ['name' => $decoded->role]
                ]);

                $_SESSION['user'] = self::$user;

                if (!empty($roles) && !in_array(self::$user->role, $roles)) {
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
