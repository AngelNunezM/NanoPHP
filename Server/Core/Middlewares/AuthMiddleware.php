<?php

namespace App\Core\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Config\Jwt as jwtConfig;
use App\Core\View;

/**
 * Class AuthMiddleware
 *
 * Middleware para proteger rutas verificando:
 * 1. Sesión de usuario activa.
 * 2. Token JWT válido en la cabecera Authorization.
 *
 * Uso:
 * Colocar `AuthMiddleware::handle();` al inicio de un controlador o ruta protegida.
 */
class AuthMiddleware
{
    /**
     * Verifica si hay sesión activa o un token JWT válido.
     *
     * - Si hay sesión, permite continuar.
     * - Si hay token JWT válido, decodifica el token, crea la sesión y permite continuar.
     * - Si no hay sesión ni token válido, devuelve un 401 Unauthorized en formato JSON.
     *
     * @return void
     */
    public static function verify(): void
    {
        // Iniciar sesión si no está iniciada
        session_start();

        // Obtener configuración JWT (por ejemplo, la clave secreta)
        $config = jwtConfig::get();

        // --- 1. Verificar sesión ---
        if (isset($_SESSION['user'])) {
            // Usuario ya logueado, permite continuar
            return ;
        }

        // --- 2. Verificar token JWT en la cabecera Authorization ---
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;

        if ($token) {
            try {
                // Extraer el token si viene con el prefijo "Bearer "
                if (str_starts_with($token, 'Bearer ')) {
                    $token = substr($token, 7);
                }

                // Decodificar el token usando la clave secreta y algoritmo HS256
                $decoded = JWT::decode($token, new Key($config['secret'], 'HS256'));

                // Guardar información del usuario en la sesión
                $_SESSION['user'] = [
                    'id' => $decoded->sub,
                    'username' => $decoded->username,
                    'role' => $decoded->role
                ];

                // Token válido, permite continuar
                return;
            } catch (\Exception $e) {
                // Token inválido o expirado
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Token inválido']);
                exit;
            }
        }

        // Obtener las cabeceras relevantes
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';

        // Comprobar si la request es JSON
        $isJsonRequest = stripos($contentType, 'application/json') !== false
                        || stripos($accept, 'application/json') !== false;

        if ($isJsonRequest) {
            // --- No hay token válido / API request ---
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'No te encuentras autenticado.'
            ]);
            exit;
        } else {
            // --- No hay sesión válida / Navegador ---
            View::render('auth/Login', [
                'error' => 'No te encuentras autenticado.'
            ]);
            exit;
        }
    }
}
