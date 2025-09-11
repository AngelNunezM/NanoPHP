<?php

namespace App\Core\helpers;

use App\Config\Config;

/**
 * Trait RequestData
 * 
 * Proporciona un método protegido para obtener los datos de la solicitud HTTP.
 * Soporta tanto **formularios clásicos** (GET/POST) como **JSON** en el cuerpo
 * de la request (POST, PUT, PATCH, DELETE con `application/json`).
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
     * $data = $this->getRequestData();
     * $name = $data['name'] ?? null;
     * ```
     *
     * @return array Arreglo asociativo con los datos de la request
     */
    protected function request(): array
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        // Si es JSON (POST, PUT, PATCH, DELETE con application/json)
        if (stripos($contentType, 'application/json') !== false) {
            return json_decode(file_get_contents("php://input"), true) ?? [];
        }

        // Manejo clásico de formularios
        return match ($method) {
            'GET'    => $_GET,
            'POST'   => $_POST,
            default  => json_decode(file_get_contents("php://input"), true) ?? []
        };
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
        header('Content-Type: application/json');

        // Enviar los datos codificados en JSON
        echo json_encode($data);
        exit;
    }

}
