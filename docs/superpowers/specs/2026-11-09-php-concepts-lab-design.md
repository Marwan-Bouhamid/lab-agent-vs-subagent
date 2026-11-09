# PHP Concepts Lab Design

## Intent

Create an English learning lab in `C:\Users\Solicode\Desktop\lab-agent-vs-subagent\lab-PHP` for students to research, understand, and test three PHP topics not yet covered in class: error and exception handling, namespaces, and traits. The linked technology-watch lab is a guide to the work structure only; its subject matter is not part of this lab.

## Goals

- Explain the role of each PHP concept in clear, student-friendly English.
- Ground explanations in the official PHP manual and cite sources.
- Teach all three concepts through one small, runnable task-tracker example.
- Include checks that demonstrate the expected behavior and document the results actually observed.
- Keep the requested numbered lab structure, README, and Todo list.

## Non-goals

- Recreate the technology-watch lab or its agent-specific content.
- Build a production task management application, database, web UI, or framework integration.
- Claim that PHP converts every error into an exception or that traits replace inheritance.

## Approaches

1. **Copy the reference content and structure wholesale.** Rejected because its technology-watch benchmark and AI skill subject matter do not fit PHP learning goals.
2. **Use only a short guide and code samples.** Rejected because it would omit the staged research, specification, realization, and report structure the user requested.
3. **Keep the requested structure and adapt every stage to PHP (chosen).** This preserves the user's folder list and the reference's learning-to-practice workflow, while ensuring every section serves the three PHP concepts.

## Structure and contents

Create a new `lab-PHP/` folder directly inside `C:\Users\Solicode\Desktop\lab-agent-vs-subagent`:

- `README.md`: English overview, learning goals, prerequisites, file map, and verified success criteria.
- `Todo.md`: staged checklist; keep work or claims not yet verified unchecked/marked.
- `.agents/rules/php-lab.md`: concise guidance to use official PHP sources, explain concepts simply, and report only verified test results.
- `.agents/skills/php-learning/SKILL.md`: reusable student-facing workflow for researching, explaining, testing, and reflecting on the three requested concepts.
- `1.besoin/besoin.md`: learner need, question, scope, and measurable success criteria.
- `2.benchmark/benchmark.md`: source-based explanation and comparison of the three PHP language features, with official manual references and limitations.
- `3.spec-skill/spec-skill.md`: the learning skill's purpose, inputs, steps, and output; keep its requirements aligned with the runtime skill file.
- `4.realisation/README.md`: project setup and commands to run the examples and tests.
- `4.realisation/src/`: a small dependency-free task-tracker domain model.
- `4.realisation/tests/`: executable checks for the examples.
- `5.rapport-et-presentation/rapport.md`: summary of the research, implementation, and observed test results.
- `5.rapport-et-presentation/presentation.md`: a short English presentation for explaining the three concepts.

The practical project will use a `Task` and a `Project`: namespaces organize the classes and a `HasTimestamps` trait demonstrates method reuse across both. The error-handling example will show a domain exception for an invalid or missing task and a controlled PHP warning converted to `ErrorException` with `set_error_handler()`. It will also explain that not every PHP error can be handled by a custom handler.

## Constraints

- Use PHP 8.2 or newer syntax; the available local CLI is PHP 8.5.11.
- Do not require Composer packages, a database, or a framework.
- Use only the requested three topics; do not make unsupported claims about them.
- Keep all PHP lab deliverables under `lab-PHP/`; do not change the existing agent-vs-subagent demo or its unrelated modified presentation.
- Run the examples and tests with the available PHP CLI before writing observed results into the report.
- Write all lab materials in simple English.
- Assume learners know basic PHP syntax; explain any class/object ideas needed for the examples.

## Official research consulted

The PHP manual pages consulted on November 9, 2026:

- [Using namespaces: Basics](https://www.php.net/manual/en/language.namespaces.basics.php)
- [Traits](https://www.php.net/manual/en/language.oop5.traits.php)
- [set_error_handler()](https://www.php.net/manual/en/function.set-error-handler.php)
- [ErrorException](https://www.php.net/manual/en/class.errorexception.php)
- [Throwable](https://www.php.net/manual/en/class.throwable.php)
- [Error](https://www.php.net/manual/en/class.error.php)
- [trigger_error()](https://www.php.net/manual/en/function.trigger-error.php)

The manual notes that a custom handler cannot handle several fatal/compile-time error types. The lab will demonstrate a deliberately triggered warning rather than suggesting that every error is recoverable.

## Remaining implementation choices

- Keep the code examples small and runnable from the command line.
- Use direct PHP source files and a small native test runner unless implementation reveals a compatibility issue.
- Record only the behavior actually observed on the available PHP runtime.
