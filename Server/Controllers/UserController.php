<?php 

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\View;
use App\Models\User;
use App\Services\UserService;
use Exception;

class UserController {
    use HTTP;

    private UserService $userService; 

    public function __construct(){
        $this->userService = new UserService();
    }

    public function create(): void
    {
        $request = $this->request();

        try {
            $user = new User();
            $user->name = $request['name'];
            $user->username = $request['username'];
            $user->password = password_hash($request['password'],  PASSWORD_BCRYPT);
            $user->role = $request['role'];

            $this->userService->createUser($user);
        } catch (Exception $ex) {
            // Respuesta según tipo de request
            if ($this->isJsonRequest()) {
                $this->response([
                    'success' => false,
                    "message" => $ex->getMessage()
                ], 404);
            } else {
                View::render('user/create', ['error' => $ex->getMessage()]);
            }
        }
    }

}