<?php
declare(strict_types=1);

use PhpLab\Domain\Task as DomainTask;
use PhpLab\Reporting\Task as ReportingTask;

require __DIR__ . '/TestSupport.php';

$bootstrap = dirname(__DIR__) . '/bootstrap.php';
check(is_file($bootstrap), 'namespace bootstrap is missing');
require $bootstrap;

check(class_exists(DomainTask::class), 'domain Task class is missing');
check(class_exists(ReportingTask::class), 'reporting Task class is missing');

$domainTask = new DomainTask(7, 'Prepare the PHP lab');
$reportingTask = new ReportingTask('Task report: 7');

check($domainTask::class === 'PhpLab\\Domain\\Task', 'domain Task has the wrong namespace');
check($domainTask->id() === 7, 'domain Task has the wrong ID');
check($domainTask->title() === 'Prepare the PHP lab', 'domain Task has the wrong title');
check($reportingTask::class === 'PhpLab\\Reporting\\Task', 'reporting Task has the wrong namespace');
check($reportingTask->text() === 'Task report: 7', 'reporting Task has the wrong text');

echo "PASS: namespaced task classes load without a name collision." . PHP_EOL;
