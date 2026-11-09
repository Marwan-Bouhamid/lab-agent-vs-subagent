<?php
declare(strict_types=1);

namespace PhpLab\Support;

use DateTimeImmutable;

trait HasTimestamps
{
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    protected function initializeTimestamps(?DateTimeImmutable $at = null): void
    {
        $timestamp = $at ?? new DateTimeImmutable();
        $this->createdAt = $timestamp;
        $this->updatedAt = $timestamp;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function markUpdated(?DateTimeImmutable $at = null): void
    {
        $this->updatedAt = $at ?? new DateTimeImmutable();
    }
}
