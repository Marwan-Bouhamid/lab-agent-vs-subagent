<?php
declare(strict_types=1);

namespace PhpLab\Domain;

use DateTimeImmutable;
use PhpLab\Support\HasTimestamps;

final class Task
{
    use HasTimestamps;

    public function __construct(
        private int $id,
        private string $title,
        ?DateTimeImmutable $at = null,
    ) {
        if (trim($this->title) === '') {
            throw new \InvalidArgumentException('Task title cannot be blank.');
        }

        $this->initializeTimestamps($at);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
}
