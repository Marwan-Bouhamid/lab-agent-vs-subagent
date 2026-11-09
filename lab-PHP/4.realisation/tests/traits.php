<?php
declare(strict_types=1);

use PhpLab\Domain\Project;
use PhpLab\Domain\Task;
use PhpLab\Support\HasTimestamps;

require_once __DIR__ . '/TestSupport.php';

$bootstrap = dirname(__DIR__) . '/bootstrap.php';
check(is_file($bootstrap), 'namespace bootstrap is missing');
require $bootstrap;

check(trait_exists(HasTimestamps::class), 'HasTimestamps trait is missing');

$initial = new DateTimeImmutable('2026-01-15T10:00:00+00:00');
$later = new DateTimeImmutable('2026-01-16T10:00:00+00:00');
$task = new Task(11, 'Write tests', $initial);
$project = new Project(2, 'PHP lab', $initial);

check($task->createdAt() == $initial, 'Task has the wrong creation time');
check($task->updatedAt() == $initial, 'Task has the wrong initial update time');
check($project->createdAt() == $initial, 'Project has the wrong creation time');
check($project->updatedAt() == $initial, 'Project has the wrong initial update time');

$task->markUpdated($later);
check($task->updatedAt() == $later, 'Task did not update its timestamp');
check($project->updatedAt() == $initial, 'Task update changed the Project timestamp');

$project->markUpdated($later);
check($project->updatedAt() == $later, 'Project did not update its timestamp');

echo "PASS: both classes reuse and update timestamps." . PHP_EOL;
