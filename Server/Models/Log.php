<?php

namespace App\Models;

class Log {
    public ?int $id = null;
    public string $action;
    public string $entity;
    public int $entity_id;
    public ?string $description = null;
    public ?array $old_data = null;
    public ?array $new_data = null;
    public ?string $created_at = null;

    public function __construct(array $data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                // Si son datos JSON los convertimos a array
                if (($key === "old_data" || $key === "new_data") && is_string($value)) {
                    $this->$key = json_decode($value, true);
                } else {
                    $this->$key = $value;
                }
            }
        }
    }
}