<?php

namespace App\Core\helpers;

trait Generator {
    public function rootPath(): string
    {
        return dirname(__DIR__, 3); // Ajusta el número según la profundidad de tu estructura de carpetas
    }

    public function generateRootPath(): string
    {
        $baseUrl = $_ENV['APP_URL_ROUTE'] ?? '';

        if (empty($baseUrl)) {
            // Detectar automáticamente dominio + protocolo
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

            $baseUrl = rtrim($protocol . $host . $scriptDir, '/');
        }

        return $baseUrl;
    }
}