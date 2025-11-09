<?php

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Services\RoleService;
use Exception;

class RoleController
{
    use HTTP;

    private RoleService $roleService;

    public function __construct(){
       $this->roleService = new RoleService();
    }

    public function index()
    {
        try {
            Authentication::verify();

            $data =  $this->roleService->getRoles();

            $this->response([
                "success" => true,
                "data" => $data
            ], 200);
        } catch (Exception $ex) {
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }
}