<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Models\Project;
use App\Services\ProjectService;
use App\Core\View;
use App\Services\ClientService;
use Exception;

class ProjectController {

    use HTTP;

    private ProjectService $projectService;
    private ClientService $clientService;

    public function __construct(){
        $this->projectService = new ProjectService();
        $this->clientService = new ClientService();
    }

    public function index(): void
    {
        Authentication::verify();
        $data = $this->projectService->getProjects();

        if($this->isJsonRequest()){
            $this->response([
                "success" => true,
                "data" => $data
            ], 200);
        }

        View::render('project/Project', $data);
    }

    public function show($id): void
    {
        try {
            Authentication::verify();
            $this->projectService->validateHasProject($id);
            
            $data = $this->projectService->getProjectById($id);

            if($data === null){
                throw new Exception("No se encontró el proyecto", 404);
            }
            
            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "data" => $data
                ], 200);
            } else {
                View::render('project/ProjectDetail', ['project' => $data]);
            }
        } catch (Exception $ex) {
           if($this->isJsonRequest()){
                $this->response([
                    "success" => false,
                    "error" => $ex->getMessage()
                ], $ex->getCode());
           } else {
                $this->redirect('/projects');
           }
        }
    }

    public function create(): void
    {
        Authentication::verify();
        $request = $this->request();
        
        try {
            $isConfigured = $request['isConfigured'];

            $project = new Project([
                'client_id' => $request['client_id'],
                'name' => $request['name'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'priority' => $request['priority']
            ]);

            $projectCreated = $this->projectService->createProject($project, $isConfigured);

            $this->response([
                "success" => true,
                "data" => $projectCreated
            ], 200);
            
        } catch(Exception $ex) {
            $this->response([
                "success" => false,
                "error" => $ex->getMessage()
            ], 500);
        }
    }

    public function getMembers(int $projectId): void
    {
        try {
            $data = $this->projectService->getProjectUsers($projectId);

            $this->response([
                "success" => true,
                "data" => $data
            ]);
        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }

    public function addMember(): void
    {
        $request = $this->request();

        try {
            $data = $this->projectService->addUserProject($request['user_id'], $request['project_id']);

            $this->response([
                "success" => true,
                "data" => $data,
                "message" => "Usuario asignado correctamente"
            ], 201);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }
    
    public function removeMember(int $projectId, int $userId): void
    {
        try {
            $data = $this->projectService->removeUserFromProject($projectId, $userId);

            $this->response([
                "success" => true,
                "data" => $data,
                "message" => "Usuario removido exitosamente"
            ], 200);

        } catch (Exception $ex) {
            $this->response([
                "success" => true,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }

    public function download(int $projectId): void
    {
        try {
            Authentication::verify();
            $this->projectService->validateHasProject($projectId);
            $this->projectService->downloadProject($projectId);
        } catch (Exception $ex) {
            error_log("Error en download: " . $ex->getMessage());
            if ($this->isJsonRequest()) {
                $this->response([
                    "success" => false,
                    "message" => $ex->getMessage()
                ], $ex->getCode() ?: 500);
            } else {
                echo "Error: " . $ex->getMessage();
                exit;
            }
        }
    }
}