<?php 

namespace App\Controllers;

use App\Core\helpers\HTTP;
use App\Core\Middlewares\Authentication;
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
        Authentication::verify(); // Protegemos esta ruta para asegurar que se tenga que estar autenticado

        $request = $this->request(); // Obtenemos la request

        try {
            $user = new User();
            $user->name = $request['name'];
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = password_hash($request['password'],  PASSWORD_BCRYPT);
            $user->role = $request['role'];

            if($this->userService->createUser($user)){
                $this->response([
                    "success" => true,
                    "message" => "Usuario creado exitosamente"
                ], 201);
            } else {
                $this->response([
                    "success" => false,
                    "No se logro crear el usuario"
                ], 400);
            }
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