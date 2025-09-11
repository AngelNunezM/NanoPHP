<?php

namespace App\Core;

/**
 * Class View
 * 
 * Esta clase se encarga de **renderizar las vistas** en NanoPHP.
 * Permite cargar archivos PHP desde la carpeta `views` y pasar 
 * parámetros desde los controladores.
 */
class View
{
    /**
     * Carga una vista
     * 
     * Este método incluye un archivo de vista PHP y le pasa los parámetros
     * definidos en un arreglo asociativo. Los parámetros se convierten
     * en variables disponibles dentro de la vista.
     * 
     * Ejemplo:
     * ```php
     * View::render('users/profile', ['name' => 'Juan', 'age' => 25]);
     * ```
     * Esto cargará `views/users/profile.php` y dentro de la vista
     * podrás usar `$name` y `$age`.
     * 
     * @param string $template Ruta y nombre del archivo de la vista dentro de `views` (sin extensión `.php`)
     * @param array $params Arreglo asociativo de variables que se pasarán a la vista
     * @return void
     */
    public static function render(string $template, array $params = []): void
    {
        // Extraer variables del arreglo de parámetros
        extract($params);

        // Incluir la vista correspondiente
        include __DIR__ . "/../views/{$template}.php";
    }
}
