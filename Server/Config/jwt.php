<?php

namespace App\Config;

class Jwt {

    public static function get(): array
    {
        return [
            'secret' => 'nanoPHP_secretClass_clave_12903op', // Cambiar por un valor fuerte
            'expires_in' => 3600 // Segundos, por ejemplo 1 hora
        ];
    }

}