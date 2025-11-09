<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Services\LogService;
use Exception;

class LogController {
    
    use HTTP;

    private LogService $logService;

    public function __construct(){
        $this->logService = new LogService();
    }

    public function index(): void
    {
        Authentication::verify(['Administrador']);

        try {
            $logs = $this->logService->getAllLogs();

            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "data" => $logs
                ], 200);
            } else {
                View::render('/log/logs', ['logs' => $logs]);
            }

        } catch (Exception $ex) {
            $this->response([
                "success" => true,
                "message" => $ex->getMessage()
            ],$ex->getCode());
        }
    }

    public function show(string $entity, int $entity_id): void 
    {
        Authentication::verify(['Administrador']);

        try {
            $logs = $this->logService->getLogsByEntity($entity, $entity_id);

            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "data" => $logs
                ], 200);
            } else {
                View::render('/log/logs', ['logs' => $logs]);
            }
            
        } catch (Exception $ex) {
            $this->response([
                "success" => true,
                "message" => $ex->getMessage()
            ],$ex->getCode());
        }
    }
}