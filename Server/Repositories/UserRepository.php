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

    public function getAll()
    {
        $consult = $this->context->prepare("
            SELECT u.id, u.name, u.username, u.email, u.password, u.isActive, r.id as 'id_role', r.name as 'name_role'
            FROM users u
            INNER JOIN roles r
            ON r.id = u.role_id;
        ");

        $consult->execute();

        $responses = $consult->fetchAll(PDO::FETCH_ASSOC);
        
        return array_map(function($response) {
            return new User([
                'id' => $response['id'],
                'name' => $response['name'],
                'username' => $response['username'],
                'email' => $response['email'],
                'password' => $response['password'],
                'isActive' => $response['isActive'],
                'role_id' => $response['id_role'],
                'role' => [
                    'id' => $response['id_role'],
                    'name' => $response['name_role']
                ]
            ]);
        }, $responses);
    }

    public function findBy(string $columnName, $value): ?User // Obtiene un usuario que coincida con la columna indicada
    {
        $consult = $this->context->prepare("
            SELECT u.id, u.name, u.username, u.email, u.password, u.isActive, r.id as 'id_role', r.name as 'name_role'
            FROM users u
            INNER JOIN roles r
            ON r.id = u.role_id
            WHERE u.$columnName = :value
            LIMIT 1;
        ");

        $consult->execute(['value' => $value]);

        $response = $consult->fetch(PDO::FETCH_ASSOC);
        
        if (!$response) {
            return null; // No se encontró
        }

        return new User([
            'id' => $response['id'],
            'name' => $response['name'],
            'username' => $response['username'],
            'email' => $response['email'],
            'password' => $response['password'],
            'isActive' => $response['isActive'],
            'role_id' => $response['id_role'],
            'role' => [
                'id' => $response['id_role'],
                'name' => $response['name_role']
            ]
        ]);
    }

    public function add(User $user): bool
    {
        $consult = $this->context->prepare("INSERT INTO users(name, username, email, password, role_id) VALUES(:name, :username, :email, :password, :role_id)");
        $consult->execute([
            "name"     => $user->name,
            "username" => $user->username,
            "email"    => $user->email,
            "password" => $user->password,
            "role_id"  => $user->role_id
        ]);

        return $this->context->lastInsertId();
    }

    public function update(User $user)
    {
        $consult = $this->context->prepare("UPDATE users SET name = :name, username = :username, email = :email, " . 
            ($user->password ? "password = :password, " : "") .
            "role_id = :role_id WHERE id = :id");
        
        $params = [
            "id"       => $user->id,
            "name"     => $user->name,
            "username" => $user->username,
            "email"    => $user->email,
            "role_id"  => $user->role_id
        ];

        if ($user->password) {
            $params["password"] = $user->password;
        }

        $consult->execute($params);

        return $this->context->lastInsertId();
    }

    public function changeStatus(int $userId): bool
    {
        $consult = $this->context->prepare("UPDATE users  SET isActive = NOT isActive  WHERE users.id = :UserId");
        $consult->execute([
            "UserId" => $userId
        ]);

        return $consult->rowCount() === 1;
    }
}