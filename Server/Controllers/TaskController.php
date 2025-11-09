<?php

namespace App\Controllers;

use App\Services\TaskService;

class TaskController
{
    private TaskService $taskService;

    public function __construct()
    {
        $this->taskService = new TaskService();
    }

    public function create()
    {
        
    }
}