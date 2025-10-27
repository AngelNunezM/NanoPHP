<?php

namespace App\Core\helpers;

use App\Config\Config;
use App\Config\Jwt as jwtConfig;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

/**
 * Trait HTTP
 * 
 */
trait HTTP
{
    /**
     * Obtiene los datos de la request
     * 
     * Dependiendo del método HTTP y del tipo de contenido:
     * - Si el Content-Type es `application/json`, decodifica el JSON del cuerpo.
     * - Si es un formulario clásico, obtiene los datos de `$_GET` o `$_POST`.
     * - Para otros métodos, intenta decodificar JSON del cuerpo por defecto.
     * 
     * Ejemplo de uso en un controlador:
     * ```php
     * $data = $this->request();
     * $name = $data['name'] ?? null;
     * ```
     *
     * @return array Arreglo asociativo con los datos de la request
     */
    protected function request(): array
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        $data = [];

        // 📦 Si es multipart/form-data (subida de archivos)
        if (stripos($contentType, 'multipart/form-data') !== false) {
            $data = array_merge($_POST, ['_files' => $_FILES]);
        }
        // 📄 Si es JSON
        elseif (stripos($contentType, 'application/json') !== false) {
            $data = json_decode(file_get_contents("php://input"), true) ?? [];
        }
        // 🔹 Formularios normales
        else {
            if ($method === 'POST') {
                $data = $_POST;
            } elseif ($method === 'GET') {
                $data = $_GET;
            }
        }

        // 🔹 Siempre añadir query params para GET y POST
        $data = array_merge($data, $_GET);

        return $data;
    }


    /**
     * Determina si la request actual es de tipo JSON.
     *
     * Este método permite diferenciar entre solicitudes de tipo API y solicitudes web tradicionales.
     * Verifica tanto la cabecera 'Content-Type' como la cabecera 'Accept' para mayor compatibilidad.
     *
     * Comportamiento:
     * - Devuelve true si 'Content-Type' incluye 'application/json'.
     * - Devuelve true si 'Accept' incluye 'application/json'.
     * - Devuelve false en cualquier otro caso.
     *
     * Esto es útil para:
     * - Decidir si responder con JSON (para clientes API, AJAX, Postman, etc.).
     * - Decidir si redirigir o mostrar una vista HTML en aplicaciones híbridas.
     *
     * @return bool True si la request es JSON, false si no lo es.
     */
    private function isJsonRequest(): bool
    {
        // Obtener la cabecera Content-Type (tipo de contenido enviado)
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        // Obtener la cabecera Accept (tipo de contenido que el cliente espera recibir)
        $accept = $_SERVER['HTTP_ACCEPT'] ?? '';

        // Comprobar si alguna de las cabeceras indica JSON
        return stripos($contentType, 'application/json') !== false
            || stripos($accept, 'application/json') !== false;
    }


    /**
     * Redirige al usuario a una ruta específica dentro del sitio.
     *
     * Construye la URL completa usando la base_url definida en la configuración
     * y realiza la redirección con la cabecera HTTP 'Location'.
     *
     * @param string $path La ruta relativa a la que se desea redirigir (ej: '/login').
     * @return void
     */
    public function redirect(string $path): void
    {
        // Cargar configuración del proyecto
        $config = Config::getBaseUrl();

        // Obtener la base URL y asegurarse de que no tenga slash final
        $baseUrl = rtrim($config['base_url'], '/');

        // Redirigir a la URL completa
        header('Location: ' . $baseUrl . $path);
        exit;
    }

    /**
     * Envía una respuesta JSON al cliente.
     *
     * Configura el código de estado HTTP y la cabecera 'Content-Type: application/json',
     * luego imprime el array $data codificado en JSON.
     *
     * @param array $data Los datos que se enviarán en la respuesta JSON.
     * @param int $status Código de estado HTTP (por defecto 200 OK).
     * @return void
     */
    public function response(array $data, int $status = 200): void
    {
        // Establecer el código de estado HTTP
        http_response_code($status);

        // Indicar que la respuesta es JSON
        header('Content-Type: application/json; charset=utf-8');

        // Enviar los datos codificados en JSON
        echo json_encode($data,  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Obtiene y valida el token Bearer enviado en la cabecera Authorization.
     *
     * Este método busca un header con el formato:
     * 
     *     Authorization: Bearer <token>
     * 
     * Si encuentra un token válido, lo decodifica usando la librería Firebase\JWT
     * y devuelve el payload (normalmente un objeto con los datos del usuario).
     *
     * @return object|null Retorna el payload decodificado como stdClass si el token es válido,
     *                     o null si no existe el header Authorization.
     *
     * @throws void Maneja internamente las excepciones y responde con JSON:
     *              - 401 si el token está expirado o la firma es inválida.
     *              - 400 si ocurre otro error al decodificar.
     */
    public function getBearerToken(): ?object {
        // Obtener todos los headers de la petición
        $headers = getallheaders();

        // Verificar que exista el header Authorization
        if (!isset($headers['Authorization'])) {
            return null;
        }

        // Extraer el token si cumple con el formato "Bearer <token>"
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            try {
                // Obtener configuración JWT (clave secreta, expiración, etc.)
                $jwt = jwtConfig::get();

                // Decodificar el token usando la clave y algoritmo HS256
                $decoded = JWT::decode(
                    $matches[1],
                    new Key($jwt['secret'], 'HS256')
                );

                // Retornar el payload decodificado (ej: user_id, username, role, exp, etc.)
                return $decoded;

            } catch (ExpiredException $e) {
                // Token válido pero caducado
                $this->response([
                    "success" => false,
                    'message' => 'El token ha expirado'
                ], 401);

            } catch (SignatureInvalidException $e) {
                // Token manipulado o firmado con otra clave
                $this->response([
                    "success" => false,
                    'message' => 'Firma inválida'
                ], 401);

            } catch (Exception $e) {
                // Cualquier otro error de decodificación
                $this->response([
                    "success" => false,
                    'message' => 'Token inválido'
                ], 401);
            }
        }

        // Si el header Authorization no tiene formato válido
        return null;
    }

}
