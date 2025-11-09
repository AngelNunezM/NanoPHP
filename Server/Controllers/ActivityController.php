<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Services\ActivityService;
use Exception;

class ActivityController
{
    use HTTP;

    private ActivityService $activityService;

    public function __construct(){
        $this->activityService = new ActivityService();
    }

    public function index()
    {
        Authentication::verify();
        
        try {
            if($this->isJsonRequest()){
                $this->response([
                    'message' => 'Lista de actividades',
                    'data' => []
                ], 200);
            } else {
                View::render('activities/Activities');
            }

        } catch (Exception $ex) {
            $this->response([
                'message' => 'Error al obtener las actividades',
                'error' => $ex->getMessage()
            ], 500);
        }
    }
}