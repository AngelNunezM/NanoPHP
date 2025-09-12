<?php

namespace App\Config;

class Config
{
    public static function getBaseUrl(): array
    {
        return [
            // Base URL de tu proyecto (apunta a la carpeta Public)
            'base_url' => '/NanoPHP/Public'
        ];
    }
}

