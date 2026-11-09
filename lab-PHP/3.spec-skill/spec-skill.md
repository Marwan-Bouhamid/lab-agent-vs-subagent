# Skill specification: PHP Learning

## Name

`php-learning`

## Purpose

Help a learner study PHP namespaces, traits, and error or exception handling using official PHP documentation, the task-tracker example, and native PHP tests.

## Input

The learner's question or current explanation about one of the three concepts, plus the matching part of the task-tracker example.

## Steps

1. Ask what the learner currently understands.
2. Read the matching explanation in `2.benchmark/benchmark.md` and consult its official PHP manual source.
3. Inspect the corresponding implementation in `4.realisation/src/`.
4. Run the matching check from the `lab-PHP` directory:
   - Namespaces: `php 4.realisation/tests/namespaces.php`
   - Traits: `php 4.realisation/tests/traits.php`
   - Errors and exceptions: `php 4.realisation/tests/errors-and-exceptions.php`
5. Explain the concept in simple English using the observed test output. Report a failure honestly.
6. Ask the learner to name one thing learned and one question that remains.

## Expected student output

- A short explanation of the selected concept.
- The official PHP manual source used.
- The example inspected and the test command run.
- The result actually observed, without invented claims.
- One learning observation and any remaining question.

The runnable skill is [PHP Learning](../.agents/skills/php-learning/SKILL.md). Its name, purpose, input, steps, and expected output must remain aligned with this specification.
