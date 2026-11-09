<?php
declare(strict_types=1);

namespace PhpLab\ErrorHandling;

use ErrorException;

final class WarningToException
{
    public static function register(): void
    {
        set_error_handler(
            static function (
                int $severity,
                string $message,
                string $file,
                int $line,
            ): bool {
                if ((error_reporting() & $severity) === 0) {
                    return false;
                }

                throw new ErrorException($message, 0, $severity, $file, $line);
            },
        );
    }

    public static function restore(): void
    {
        restore_error_handler();
    }
}
