<?php
declare(strict_types=1);

namespace PhpLab\Domain;

use DateTimeImmutable;
use PhpLab\Support\HasTimestamps;

final class Project
{
    use HasTimestamps;

    public function __construct(
        private int $id,
        private string $name,
        ?DateTimeImmutable $at = null,
    ) {
        $this->initializeTimestamps($at);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
