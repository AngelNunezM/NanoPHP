<?php

namespace App\Config;

/**
 * Clase Jwt
 *
 * Esta clase centraliza la configuración relacionada con la generación
 * y validación de **JSON Web Tokens (JWT)** dentro de la aplicación.
 *
 * Su objetivo es mantener de forma clara y segura los parámetros
 * necesarios para manejar la autenticación basada en tokens.
 *
 * Actualmente devuelve:
 *   - `secret`: La clave secreta usada para firmar y verificar los tokens.
 *   - `expires_in`: Tiempo de expiración del token en segundos.
 *
 * ⚠️ IMPORTANTE:
 *   - El valor de `secret` debe ser lo suficientemente fuerte y seguro,
 *     preferiblemente cargado desde un archivo `.env` en lugar de estar
 *     hardcodeado.
 *   - Si se utiliza en producción, se recomienda generar la clave con
 *     un generador criptográfico seguro (ej. `openssl rand -base64 64`).
 *
 * Ejemplo de `.env` recomendado:
 *   JWT_SECRET="clave_super_segura_..."
 *   JWT_EXPIRES_IN=3600
 *
 * Ejemplo de uso:
 *   use App\Config\Jwt;
 *
 *   $jwtConfig = Jwt::get();
 *   echo $jwtConfig['secret'];
 *   echo $jwtConfig['expires_in'];
 */
class Jwt
{
    /**
     * Retorna la configuración JWT de la aplicación.
     *
     * Incluye la clave secreta para firmar/verificar tokens y
     * el tiempo de expiración en segundos.
     *
     * @return array<string,mixed> Configuración JWT (secret y expires_in).
     */
    public static function get(): array
    {
        return [
            'secret' => 'nanoPHP_secretClass_clave_12903op',
            'expires_in' => 28800 // Tiempo en segundos (ejemplo: 8 hora)
        ];
    }
}
