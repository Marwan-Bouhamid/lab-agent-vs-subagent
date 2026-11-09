<?php
declare(strict_types=1);

function check(bool $condition, string $message): void
{
    if (!$condition) {
        fwrite(STDERR, "FAIL: {$message}" . PHP_EOL);
        exit(1);
    }
}

function checkThrows(string $exceptionClass, callable $operation, string $message): Throwable
{
    try {
        $operation();
    } catch (Throwable $throwable) {
        if ($throwable instanceof $exceptionClass) {
            return $throwable;
        }

        check(false, $message . ' (unexpected ' . $throwable::class . ')');
    }

    check(false, "{$message} (no exception thrown)");
    throw new LogicException('Unreachable');
}
