<?php

namespace App\Repositories;

use App\Config\ContextDB;
use App\Models\User;
use PDO;

class UserRepository {
    
    private PDO $context;

    public function __construct() {
        $this->context = (new ContextDB())->conn;
    }

    public function findBy(string $columnName, $value): ?User // Obtiene un usuario que coincida con la columna indicada
    {
        $consult = $this->context->prepare("SELECT * FROM users WHERE $columnName = :value LIMIT 1");
        $consult->execute(['value' => $value]);

        $response = $consult->fetch(PDO::FETCH_ASSOC);
        if (!$response) {
            return null; // No se encontró
        }
        
        $user = new User(); // Instancia del usuario para devolverlo
        $user->id = $response['id'];
        $user->name = $response['name'];
        $user->username = $response['username'];
        $user->email = $response['email'];
        $user->password = $response['password'];
        $user->role = $response['role'];
        $user->active = $response['active'];
        return $user;
    }

    public function add(User $user): bool
    {
        $consult = $this->context->prepare("INSERT INTO users(name, username, email, password, role) VALUES(:name, :username, :email, :password, :role)");
        $consult->execute([
            "name" => $user->name,
            "username" => $user->username,
            "email" => $user->email,
            "password" => $user->password,
            "role" => $user->role
        ]);

        return $consult->rowCount() === 1;
    }
}