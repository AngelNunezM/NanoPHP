<?php

class Stage {
    public int $id;
    public int $project_id;
    public int $parent_id;
    public string $name;
    public string $description;
    public DateTime $start_date;
    public DateTime $end_date;
    public string $status;
    public string $priority;
    public float $progress;
}