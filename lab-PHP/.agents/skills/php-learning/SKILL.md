---
name: php-learning
description: "Use when studying, explaining, or testing PHP namespaces, traits, and error or exception handling in the task-tracker lab."
---

# PHP Learning

## Purpose

Help a learner understand the three PHP concepts in this lab through official documentation, a small example, and a test they can run.

## Input

The learner's question or explanation about namespaces, traits, or errors and exceptions, and the matching concept in the task-tracker example.

## Procedure

1. Ask the learner to explain what they currently understand in their own words.
2. Read the matching section in [the benchmark](../../../2.benchmark/benchmark.md) and use its linked official PHP manual source.
3. Inspect the matching example:
   - Namespace: `4.realisation/src/Domain/Task.php` and `4.realisation/src/Reporting/Task.php`.
   - Trait: `4.realisation/src/Support/HasTimestamps.php`, `4.realisation/src/Domain/Task.php`, and `4.realisation/src/Domain/Project.php`.
   - Errors and exceptions: `4.realisation/src/Domain/Task.php`, `4.realisation/src/Domain/TaskBoard.php`, and `4.realisation/src/ErrorHandling/WarningToException.php`.
4. Run the matching check from the `lab-PHP` directory:
   - Namespace: `php 4.realisation/tests/namespaces.php`
   - Trait: `php 4.realisation/tests/traits.php`
   - Errors and exceptions: `php 4.realisation/tests/errors-and-exceptions.php`
5. Explain the behavior in simple English and connect it to the code and observed test output. If a test fails, report the failure; do not say it passed.
6. Ask the learner to state one thing they learned and one question they still have.

## Expected output

- A short explanation of the selected concept.
- The official PHP manual source used.
- The example file and test command.
- The test result as actually observed.
- One learner observation and any remaining question.

Do not invent test results or claim that all PHP errors can be handled by a custom error handler.
