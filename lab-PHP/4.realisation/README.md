# Task-tracker realization

## Requirements

Use PHP 8.2 or newer from the command line. The example uses native PHP only: no Composer packages, database, or framework.

## Run the checks

From the `lab-PHP` directory, run the full test runner:

```powershell
php 4.realisation/tests/run.php
```

Run an individual check when studying one concept:

```powershell
php 4.realisation/tests/namespaces.php
php 4.realisation/tests/traits.php
php 4.realisation/tests/errors-and-exceptions.php
```

## Examples

- **Namespaces:** `src/Domain/Task.php` and `src/Reporting/Task.php` use the short class name `Task` in separate namespaces.
- **Traits:** `src/Support/HasTimestamps.php` supplies timestamp methods used by `Task` and `Project`.
- **Errors and exceptions:** `Task` rejects a blank title, `TaskBoard` reports an unknown task with `TaskNotFoundException`, and `WarningToException` converts an enabled user warning to `ErrorException`.

The warning handler returns `false` for a severity masked by `error_reporting()`. The test also restores the previous handler. This example does not claim that every PHP error can be handled.

See [`../2.benchmark/benchmark.md`](../2.benchmark/benchmark.md) for official PHP manual references and [`../Todo.md`](../Todo.md) for progress.
