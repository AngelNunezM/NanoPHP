<?php

namespace App\Config;

//use Dotenv\Dotenv;

/**
 * Clase Config
 *
 * Esta clase se encarga de centralizar la configuración de la aplicación
 * mediante el uso de variables de entorno cargadas desde el archivo `.env`.
 *
 * Su propósito es proporcionar un acceso estructurado y seguro a parámetros
 * globales de configuración, evitando el hardcodeo de rutas o credenciales
 * directamente en el código.
 *
 * Uso esperado:
 *   - Definir las variables necesarias en el archivo `.env`.
 *   - Asegurarse de que `Dotenv::createImmutable()->load()` sea ejecutado
 *     al inicio de la aplicación (por ejemplo en `index.php`).
 *   - Acceder a las configuraciones a través de los métodos estáticos.
 *
 * Ejemplo de `.env`:
 *   APP_URL_ROUTE=http://localhost/proyecto/Public
 *
 * Ejemplo de uso en el código:
 *   use App\Config\Config;
 *
 *   $baseConfig = Config::getBaseUrl();
 *   echo $baseConfig['base_url']; // http://localhost/proyecto/Public
 */
class Config
{
    /**
     * Obtiene la URL base de la aplicación.
     *
     * Esta URL debe estar definida en el archivo `.env` bajo la variable
     * `APP_URL_ROUTE`. El método retorna un array asociativo que incluye
     * la clave `base_url`.
     *
     * @return array<string,string> Array con la URL base de la aplicación.
     */
    public static function getBaseUrl(): array
    {
        return [
            'base_url' => $_ENV['APP_URL_ROUTE']
        ];
    }
}
