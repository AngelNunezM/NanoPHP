<?php

class Project {
    public int $id;
    public string $name;
    public string $description;
    public DateTime $start_Date;
    public DateTime $end_Date;
    public string $status;
    public string $priority;
    public float $budget;
    public float $actual_cost;

    public int $user_created;
}