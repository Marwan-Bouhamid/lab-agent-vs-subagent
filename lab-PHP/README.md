# PHP concepts lab

## Goal

This lab introduces three PHP concepts that are new to the course: error and exception handling, namespaces, and traits. You will research each concept, understand its role, and test a small example in a task tracker.

The linked technology-watch lab is used only as a guide to the work structure. Its subject matter is not part of this PHP lab.

## Requirements

- PHP 8.2 or newer on the command line.
- Basic PHP syntax, variables, functions, arrays, and simple classes.
- No Composer packages, database, or framework.

## Lab map

- [`1.besoin/besoin.md`](1.besoin/besoin.md): the learning need, scope, prerequisites, and success criteria.
- [`2.benchmark/benchmark.md`](2.benchmark/benchmark.md): explanations based on official PHP manual pages.
- [`3.spec-skill/spec-skill.md`](3.spec-skill/spec-skill.md): the student learning skill specification.
- [`.agents/rules/php-lab.md`](.agents/rules/php-lab.md): guidance for keeping explanations simple and results verified.
- [`.agents/skills/php-learning/SKILL.md`](.agents/skills/php-learning/SKILL.md): the reusable PHP learning workflow.
- [`4.realisation/README.md`](4.realisation/README.md): setup, examples, and test commands.
- `4.realisation/bootstrap.php`: autoloads classes with the `PhpLab\` prefix.
- `4.realisation/src/Domain/Task.php`: domain task, title validation, and timestamps.
- `4.realisation/src/Domain/Project.php`: project using the shared timestamp trait.
- `4.realisation/src/Domain/TaskBoard.php`: task lookup and missing-task exception.
- `4.realisation/src/Exceptions/TaskNotFoundException.php`: exception for an unknown task ID.
- `4.realisation/src/ErrorHandling/WarningToException.php`: controlled warning conversion.
- `4.realisation/src/Reporting/Task.php`: a second `Task` class in a separate namespace.
- `4.realisation/src/Support/HasTimestamps.php`: timestamp behavior shared by domain classes.
- `4.realisation/tests/TestSupport.php`: small helpers for native PHP checks.
- `4.realisation/tests/namespaces.php`: checks the two distinct `Task` classes.
- `4.realisation/tests/traits.php`: checks timestamp reuse and updates.
- `4.realisation/tests/errors-and-exceptions.php`: checks validation, lookup, and warning handling.
- `4.realisation/tests/run.php`: runs all three checks.
- [`Todo.md`](Todo.md): lab progress checklist.
- [`5.rapport-et-presentation/rapport.md`](5.rapport-et-presentation/rapport.md): research, implementation, and observed outcomes.
- [`5.rapport-et-presentation/presentation.md`](5.rapport-et-presentation/presentation.md): short oral presentation.

## What you will learn

- **Namespaces:** organize names and keep the domain `Task` separate from the reporting `Task`.
- **Traits:** share timestamp methods between `Task` and `Project` without making one inherit from the other.
- **Errors and exceptions:** reject a blank task title, report an unknown task, and convert one enabled `E_USER_WARNING` into an `ErrorException`.

The warning example is deliberately limited. A custom error handler cannot handle every PHP error; see the official manual references in the benchmark.

## Success criteria

You can explain the role of each concept in your own words, point to its task-tracker example, run the matching test, and describe only the result you observed.
