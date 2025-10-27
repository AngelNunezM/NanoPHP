<?php

namespace App\Models;
class Role {
    public ?int $id;
    public string $name;

    public function __construct(array $data = []) {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? '';
        }
    }
}