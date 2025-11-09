<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use Exception;


class UserService
{
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function getUsers(){
        return $this->userRepository->getAll();
    }

    public function getUserById(int $id): ?User
    {
        $user = $this->userRepository->findBy('id', $id);
        
        if (!$user) {
            throw new Exception("Usuario no encontrado", 404);
        }

        return $user;
    }

    public function createUser(User $user): User
    {
        $isExistUser = $this->userRepository->findBy('username', $user->username);

        if($isExistUser) {
            throw new Exception("Ya existe un cuenta con este nombre de usuario, prueba con otro". 409);
        }

        $isUserCreated = $this->userRepository->add($user);

        if(!$isUserCreated) {
            throw new Exception("Hubo un error al crear el usuario en la bd.", 500);
        }

        return $this->getUserById($isUserCreated);
    }

    public function updateUser(User $user): User
    {
        $isUserUpdated = $this->userRepository->update($user);

        if(!$isUserUpdated) {
            throw new Exception("Hubo un error al actualizar el usuario en la bd.", 500);
        }

        return $this->getUserById($user->id);
    }

    public function changeUserStatus(int $userId): User
    {
        $isStatusChanged = $this->userRepository->changeStatus($userId);

        if(!$isStatusChanged) {
            throw new Exception("Hubo un error al cambiar el estado del usuario en la bd.", 500);
        }

        return $this->getUserById($userId);
    }
}