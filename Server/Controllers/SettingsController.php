<?php

namespace App\Controllers;

use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Core\helpers\HTTP;

class SettingsController
{
    use HTTP;

    public function index()
    {
        Authentication::verify();
        return View::render('settings/General');
    }
    
    public function administration()
    {
        Authentication::verify(['Administrador']);
        return View::render('settings/Administration');
    }

    public function security()
    {
        Authentication::verify();
        return View::render('settings/Security');
    }

    public function aparience()
    {
        Authentication::verify();
        return View::render('settings/Aparience');
    }

    public function saveStructure()
    {
        Authentication::verify(['Administrador']);

        try {
            $request = $this->request();
            $structure = $request; // El body completo es la estructura

            if (empty($structure)) {
                throw new \Exception("No se recibió ninguna estructura", 400);
            }

            $jsonPath = __DIR__ . '/../../ProjectDefaultStructure.json';
            
            // Convertir a JSON con formato bonito
            $jsonContent = json_encode($structure, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
            if ($jsonContent === false) {
                throw new \Exception("Error al codificar la estructura a JSON", 500);
            }

            // Guardar en el archivo
            if (file_put_contents($jsonPath, $jsonContent) === false) {
                throw new \Exception("No se pudo guardar el archivo", 500);
            }

            $this->response([
                "success" => true,
                "message" => "Estructura guardada exitosamente"
            ], 200);

        } catch (\Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode() ?: 500);
        }
    }
}