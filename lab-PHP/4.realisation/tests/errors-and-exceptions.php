<?php
declare(strict_types=1);

use PhpLab\Domain\Task;
use PhpLab\Domain\TaskBoard;
use PhpLab\ErrorHandling\WarningToException;
use PhpLab\Exceptions\TaskNotFoundException;

require_once __DIR__ . '/TestSupport.php';

$bootstrap = dirname(__DIR__) . '/bootstrap.php';
check(is_file($bootstrap), 'namespace bootstrap is missing');
require_once $bootstrap;

checkThrows(
    InvalidArgumentException::class,
    static fn () => new Task(1, '   '),
    'blank task title must be rejected',
);

$board = new TaskBoard([
    new Task(1, 'Prepare the demo'),
    new Task(2, 'Write the report'),
]);
check($board->find(2)->title() === 'Write the report', 'known task lookup returned the wrong task');
checkThrows(
    TaskNotFoundException::class,
    static fn () => $board->find(99),
    'unknown task ID must raise TaskNotFoundException',
);

$receivedWarnings = [];
$previousHandler = static function (int $severity, string $message) use (&$receivedWarnings): bool {
    $receivedWarnings[] = [$severity, $message];
    return true;
};
$originalReporting = error_reporting();
set_error_handler($previousHandler, E_USER_WARNING);

$converted = null;
$maskedWarningCompleted = false;
try {
    WarningToException::register();
    try {
        try {
            trigger_error('Enabled warning', E_USER_WARNING);
        } catch (ErrorException $exception) {
            $converted = $exception;
        }

        $reportingBeforeMask = error_reporting();
        error_reporting($reportingBeforeMask & ~E_USER_WARNING);
        try {
            trigger_error('Masked warning', E_USER_WARNING);
            $maskedWarningCompleted = true;
        } finally {
            error_reporting($reportingBeforeMask);
        }
    } finally {
        WarningToException::restore();
    }

    trigger_error('Warning after restore', E_USER_WARNING);
} finally {
    restore_error_handler();
    error_reporting($originalReporting);
}

check($converted instanceof ErrorException, 'enabled warning was not converted to ErrorException');
check($converted->getSeverity() === E_USER_WARNING, 'converted warning has the wrong severity');
check($maskedWarningCompleted, 'masked warning was converted instead of being ignored');
check(
    $receivedWarnings === [[E_USER_WARNING, 'Warning after restore']],
    'previous error handler did not receive the warning after restoration',
);

echo "PASS: expected exceptions and warning conversion are handled." . PHP_EOL;
