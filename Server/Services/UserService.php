<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Core\helpers\HTTP;
use App\Core\View;
use App\Models\User;
use Exception;


class UserService
{
    use HTTP;

    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function createUser(User $user): bool
    {
        $isExistUser = $this->userRepository->findBy('username', $user->username);

        if($isExistUser) {
            throw new Exception("Ya existe un cuenta con este nombre de usuario, prueba con otro");
        }

        return $this->userRepository->add($user);
    }
}