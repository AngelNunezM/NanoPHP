<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\View;
use App\Models\ProtectedUrl;
use App\Services\ProjectService;
use App\Services\ProtectedUrlService;
use DateTime;
use Exception;

class ProtectedUrlController {

    use HTTP;

    private ProtectedUrlService $protectedUrlService;
    private ProjectService $projectService;

    public function __construct() {
        $this->protectedUrlService = new ProtectedUrlService();
        $this->projectService = new ProjectService();
    }

    public function show(int $projectId): void
    {
        $url = $this->protectedUrlService->getProtectedUrlByProjectId($projectId);

        $this->response([
            "success" => true,
            "data" => $url
        ]);
    }

    public function create(): void
    {
        $request = $this->request();

        try {
            $protectedUrl = new ProtectedUrl([
                'resource_id' => $request['resource_id'] ?? null
            ]);

            $url = $this->protectedUrlService->createProtectedUrl($protectedUrl);

            $this->response([
                "success" => true,
                "url" => $url
            ], 201);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => "Error al crear la ruta protegida: " . $ex->getMessage()
            ], 500);
        }
    }

    public function access(): void
    {
        $request = $this->request();
        $token = $request['token'] ?? null;

        if(!$token){
            if($this->isJsonRequest()){
                $this->response([
                    "success" => false,
                    "message" => "El token es requerido."
                ], 401);
            } else {
                $this->redirect('/');
            }
        }

        try {
            $protectUrl = $this->protectedUrlService->getProtectedUrl($token);

            if (!$protectUrl) {
                if($this->isJsonRequest()){
                    $this->response([
                        "success" => false,
                        "message" => "Token invalido. Parece que el recurso no existe o ha sido eliminado."
                    ], 404);
                } else {
                     $this->redirect('/404');
                }
            }

            $project = $this->projectService->getProjectById($protectUrl->resource_id);
            $project->stages = [];
            
            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "project" => $project
                ], 200);
            } else {
                 View::render('project/ProjectShared', ['project' => $project]);
            }
            
        } catch (Exception $ex) {
            if($this->isJsonRequest()){
                $this->response([
                    "success" => false,
                    "message" => $ex->getMessage()
                ], 500);
            } else {
                $this->redirect('/404');
            }
        }
    }
}