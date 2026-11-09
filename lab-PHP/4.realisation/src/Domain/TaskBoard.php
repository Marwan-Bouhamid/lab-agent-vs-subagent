<?php
declare(strict_types=1);

namespace PhpLab\Domain;

use InvalidArgumentException;
use PhpLab\Exceptions\TaskNotFoundException;

final class TaskBoard
{
    private array $tasksById = [];

    public function __construct(array $tasks)
    {
        foreach ($tasks as $task) {
            if (!$task instanceof Task) {
                throw new InvalidArgumentException('TaskBoard accepts only Task objects.');
            }

            $this->tasksById[$task->id()] = $task;
        }
    }

    public function find(int $id): Task
    {
        if (!isset($this->tasksById[$id])) {
            throw new TaskNotFoundException("Task {$id} was not found.");
        }

        return $this->tasksById[$id];
    }
}
