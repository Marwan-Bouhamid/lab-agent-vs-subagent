<?php
declare(strict_types=1);

namespace PhpLab\Reporting;

final class Task
{
    public function __construct(
        private string $text,
    ) {
    }

    public function text(): string
    {
        return $this->text;
    }
}
