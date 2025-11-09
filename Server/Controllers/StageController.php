<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Models\Stage;
use App\Services\StageService;
use Exception;

class StageController {

    use HTTP;

    private StageService $stageService;

    public function __construct(){
        $this->stageService = new StageService();
    }

    public function index()
    {
        $this->stageService->getStages();
    }

    public function show(int $stageId)
    {
        try {
            $stage = $this->stageService->getStageById($stageId);
            $this->response([
                "success" => true,
                "data" => $stage
            ], 200);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function create(): void
    {
        $request = $this->request();

        $stage = new Stage([
            'name' => $request['name'],
            'description' => $request['description'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'project_id' => $request['project_id'],
            'parent_id' => $request['parent_id'],
        ]);

        try {
            $createdStage = $this->stageService->createStage($stage);

            $this->response([
                "success" => true,
                "data" => $createdStage,
                "message" => 'Etapa creada exitosamente.'
            ], 201);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function delete(int $stageId)
    {
        try{
            $this->stageService->deleteStage($stageId);
            
        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], $ex->getCode());
        }
    }

    public function update(int $stageId)
    {
        $request = $this->request();
        
        try {
            $stage = new Stage([
                'id' => $stageId,
                'name' => $request['name'],
                'description' => $request['description'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date']
            ]);

            $this->stageService->updateStage($stage);
            
            $this->response([
                "success" => true,
                "data" => [],
                "message" => "Etapa actualizada correctamente"
            ], 200);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function updateTrafficLight(int $stageId): void
    {
        $request = $this->request();
        
        try {

            $this->stageService->updateTrafficLight($stageId, $request['status_traffic_light']);
            
            $this->response([
                "success" => true,
                "data" => [],
                "message" => "Semáforo de la etapa actualizado correctamente"
            ], 200);

        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }
}