<?php

namespace App\Services;

use App\Models\Log;
use App\Repositories\LogRepository;

class LogService {
    private LogRepository $logRepository;

    public function __construct() {
        $this->logRepository = new LogRepository();
    }

    public function log(string $action, string $entity, int $entity_id, ?string $description = null, ?array $old_data = null, ?array $new_data = null): void {
        $log = new Log([
            "action" => $action,
            "entity" => $entity,
            "entity_id" => $entity_id,
            "description" => $description,
            "old_data" => $old_data,
            "new_data" => $new_data
        ]);

        $this->logRepository->create($log);
    }

    public function getAllLogs(int $limit = 100): array {
        return $this->logRepository->getAll($limit);
    }

    public function getLogsByEntity(string $entity, int $entity_id): array {
        return $this->logRepository->getByEntity($entity, $entity_id);
    }
}