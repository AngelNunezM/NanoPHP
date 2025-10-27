<?php

namespace App\Models;

use App\Models\Role;

class User {
    public ?int $id = null;
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public bool $isActive = true;
    public int $role_id;

    // Un usuario tiene asociado un rol
    public ?Role $role = null;

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? '';
            $this->username = $data['username'] ?? '';
            $this->email = $data['email'] ?? '';
            $this->password = $data['password'] ?? '';
            $this->isActive = isset($data['isActive']) ? (bool)$data['isActive'] : true;
            $this->role_id = $data['role_id'] ?? 0;

            // Inicializar el rol si está presente
            if (isset($data['role'])) {
                $this->role = new Role($data['role']);
            }
        }
    }
}
