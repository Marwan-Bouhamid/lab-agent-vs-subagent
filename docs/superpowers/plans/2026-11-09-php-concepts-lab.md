# PHP Concepts Lab Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task. The work must stay inside `lab-PHP/`; preserve the existing presentation edit.

**Goal:** Build an English PHP learning lab in `C:\Users\Solicode\Desktop\lab-agent-vs-subagent\lab-PHP` about error and exception handling, namespaces, and traits.

**Architecture:** Follow the requested staged folder structure. Use a small dependency-free command-line task-tracker example to teach and test all three concepts; use native PHP checks and PHP manual sources, then report only observed results.

**Tech Stack:** PHP 8.2+ syntax, PHP CLI, Markdown, no Composer packages.

**Spec:** `docs/superpowers/specs/2026-11-09-php-concepts-lab-design.md`

## Global Constraints

- Create the new lab at `C:\Users\Solicode\Desktop\lab-agent-vs-subagent\lab-PHP`.
- Keep all PHP lab deliverables under `lab-PHP/`; do not change the existing agent-vs-subagent demo or its unrelated modified presentation.
- Use PHP 8.2 or newer syntax; the available local CLI is PHP 8.5.11.
- Do not require Composer packages, a database, or a framework.
- Use only the requested three topics; do not make unsupported claims about them.
- Run the examples and tests with the available PHP CLI before writing observed results into the report.
- Write all lab materials in simple English.
- Assume learners know basic PHP syntax; explain any class/object ideas needed for the examples.

## Review Focus

- Two classes share the short name `Task`; importing them under distinct aliases must load both without a name collision. Pin this in Task 1’s namespace check.
- A blank task title must be rejected with the documented exception type, not silently accepted. Pin this in Task 3’s exception check.
- Looking up an unknown task ID must produce `TaskNotFoundException`, while a known ID returns its task. Pin both outcomes in Task 3.
- A registered handler must convert an enabled, controlled `E_USER_WARNING` into `ErrorException`, leave a masked warning to the normal PHP handler, and restore the previous handler even when an exception is thrown. Pin these outcomes in Task 3.
- Both classes using `HasTimestamps` must receive an initial timestamp and independently update it to a supplied later instant. Pin this in Task 2.

---

### Task 1: Create the namespaced task-tracker foundation

**Files:**
- Create: `lab-PHP/4.realisation/bootstrap.php`
- Create: `lab-PHP/4.realisation/src/Domain/Task.php`
- Create: `lab-PHP/4.realisation/src/Domain/Project.php`
- Create: `lab-PHP/4.realisation/src/Reporting/Task.php`
- Create: `lab-PHP/4.realisation/tests/TestSupport.php`
- Create: `lab-PHP/4.realisation/tests/namespaces.php`
- Create: `lab-PHP/4.realisation/tests/run.php`

**Interfaces:**
- Produces: autoload support for the `PhpLab\` namespace from `4.realisation/src/`; `PhpLab\Domain\Task::__construct(int $id, string $title)` with `id(): int` and `title(): string`; `PhpLab\Domain\Project::__construct(int $id, string $name)` with `id(): int` and `name(): string`; `PhpLab\Reporting\Task::__construct(string $text)` with `text(): string`; and test helpers `check(bool $condition, string $message): void` and `checkThrows(string $exceptionClass, callable $operation, string $message): Throwable`.

- [ ] Write `TestSupport.php` and `namespaces.php` to check that both `PhpLab\Domain\Task` and `PhpLab\Reporting\Task` load under aliases and expose the specified values; a missing bootstrap/class must produce a clear `FAIL` result.
- [ ] Run `php lab-PHP/4.realisation/tests/namespaces.php` and confirm it fails with the expected missing-bootstrap/class assertion, not a PHP fatal error.
- [ ] Implement the minimal namespace-based files and `bootstrap.php` autoloader for the `PhpLab\` prefix.
- [ ] Run `php lab-PHP/4.realisation/tests/namespaces.php` and confirm it prints `PASS: namespaced task classes load without a name collision.`
- [ ] Add the namespace check to `tests/run.php`; run `php lab-PHP/4.realisation/tests/run.php` and confirm exit code 0.

### Task 2: Reuse timestamps with a trait

**Files:**
- Create: `lab-PHP/4.realisation/src/Support/HasTimestamps.php`
- Modify: `lab-PHP/4.realisation/src/Domain/Task.php`
- Modify: `lab-PHP/4.realisation/src/Domain/Project.php`
- Create: `lab-PHP/4.realisation/tests/traits.php`
- Modify: `lab-PHP/4.realisation/tests/run.php`

**Interfaces:**
- Consumes: Task 1’s `PhpLab\Domain\Task` and `PhpLab\Domain\Project`.
- Produces: `PhpLab\Support\HasTimestamps`, with `initializeTimestamps(?DateTimeImmutable $at = null): void`, `createdAt(): DateTimeImmutable`, `updatedAt(): DateTimeImmutable`, and `markUpdated(?DateTimeImmutable $at = null): void`, used by both domain classes. Their constructors accept an optional third timestamp argument for deterministic tests.

- [ ] Write `traits.php` to verify initial timestamps on both classes and independent updates to a fixed later instant.
- [ ] Run `php lab-PHP/4.realisation/tests/traits.php` and confirm it fails because the trait and timestamp methods are absent.
- [ ] Add the trait and use it in both classes; initialize each instance’s timestamps through the constructor.
- [ ] Run `php lab-PHP/4.realisation/tests/traits.php` and confirm it prints `PASS: both classes reuse and update timestamps.`
- [ ] Add the trait check to `tests/run.php`; run `php lab-PHP/4.realisation/tests/run.php` and confirm exit code 0.

### Task 3: Handle domain exceptions and PHP warnings

**Files:**
- Create: `lab-PHP/4.realisation/src/Exceptions/TaskNotFoundException.php`
- Create: `lab-PHP/4.realisation/src/Domain/TaskBoard.php`
- Create: `lab-PHP/4.realisation/src/ErrorHandling/WarningToException.php`
- Create: `lab-PHP/4.realisation/tests/errors-and-exceptions.php`
- Modify: `lab-PHP/4.realisation/src/Domain/Task.php`
- Modify: `lab-PHP/4.realisation/tests/run.php`

**Interfaces:**
- Consumes: Task 1’s autoloader and `PhpLab\Domain\Task`; Task 2’s task timestamp initialization.
- Produces: `PhpLab\Domain\TaskBoard::__construct(array $tasks)` and `find(int $id): Task`; `PhpLab\Exceptions\TaskNotFoundException extends RuntimeException`; `PhpLab\ErrorHandling\WarningToException::register(): void` and `restore(): void`.

- [ ] Write `errors-and-exceptions.php` to check blank-title `InvalidArgumentException`, successful lookup of a known ID, `TaskNotFoundException` for an unknown ID, and conversion of an enabled `E_USER_WARNING` to `ErrorException`.
- [ ] In the warning test, use `try/finally` to restore the previous PHP error handler, verify a masked warning is not converted, and verify a previously registered handler receives a warning after restoration.
- [ ] Run `php lab-PHP/4.realisation/tests/errors-and-exceptions.php` and confirm it fails because the planned validation, exception, finder, and handler are absent.
- [ ] Implement only those behaviors; the handler must return `false` for severities masked by `error_reporting()` and throw `ErrorException` for an enabled warning.
- [ ] Run `php lab-PHP/4.realisation/tests/errors-and-exceptions.php` and confirm it prints `PASS: expected exceptions and warning conversion are handled.`
- [ ] Add the errors-and-exceptions check to `tests/run.php`; run `php lab-PHP/4.realisation/tests/run.php` and confirm all three checks pass.

### Task 4: Write the learning need and PHP research

**Files:**
- Create: `lab-PHP/1.besoin/besoin.md`
- Create: `lab-PHP/2.benchmark/benchmark.md`

**Interfaces:**
- Consumes: the approved design and the namespaced classes, trait, and error-handling behavior implemented in Tasks 1–3.
- Produces: English learner objectives and a source-cited explanation of the three concepts.

- [ ] Write the need document with the question, scope, assumed prerequisites, non-goals, and observable success criteria.
- [ ] Write the benchmark using the official PHP manual: explain namespaces, trait composition, `Throwable`/`Exception`/`Error`, `set_error_handler()`, and the limits of custom error handlers.
- [ ] Cite only the PHP manual pages consulted for each factual claim; distinguish PHP behavior from the lab’s teaching choices.
- [ ] Manually check the English and verify every reference URL corresponds to an official PHP manual page.

### Task 5: Define the study skill and repository guidance

**Files:**
- Create: `lab-PHP/.agents/rules/php-lab.md`
- Create: `lab-PHP/.agents/skills/php-learning/SKILL.md`
- Create: `lab-PHP/3.spec-skill/spec-skill.md`

**Interfaces:**
- Consumes: the design, research, examples, and tests from Tasks 1–4.
- Produces: a concise student learning workflow documented as both a specification and a skill, plus matching lab guidance.

- [ ] Define a skill workflow that asks the learner to explain each concept, inspect the matching source, run the matching example/test, and record an observation.
- [ ] Keep the skill limited to the requested PHP concepts; require official sources and verified test results.
- [ ] Keep `spec-skill.md` and `SKILL.md` aligned on the skill name, purpose, input, steps, and expected student output.
- [ ] Manually verify the skill metadata and Markdown structure.

### Task 6: Add project instructions and root README/Todo

**Files:**
- Create: `lab-PHP/4.realisation/README.md`
- Create: `lab-PHP/README.md`
- Create: `lab-PHP/Todo.md`

**Interfaces:**
- Consumes: the deliverable paths and commands from Tasks 1–5.
- Produces: runnable project instructions, a map of the lab stages, and a progress checklist.

- [ ] Document PHP 8.2+ requirements, the command `php 4.realisation/tests/run.php`, and the individual test scripts.
- [ ] Explain the expected behavior and task-tracker role of each concept without reporting results before Task 7.
- [ ] List every lab file/folder in the root README and define success criteria.
- [ ] Add a Todo checklist for the need, research, skill, practical example, tests, report, and presentation; keep unchecked any work not yet verified.
- [ ] Manually verify all README links and paths resolve within `lab-PHP/`.

### Task 7: Write the report and oral presentation from verified results

**Files:**
- Create: `lab-PHP/5.rapport-et-presentation/rapport.md`
- Create: `lab-PHP/5.rapport-et-presentation/presentation.md`
- Modify: `lab-PHP/Todo.md`

**Interfaces:**
- Consumes: source-based explanations and actual test output from Tasks 1–6.
- Produces: an English report and a concise presentation that do not claim unrun or unsupported results.

- [ ] Summarize the three roles and their actual task-tracker examples in the report, citing PHP manual sources.
- [ ] Record the PHP version and only the outcomes observed when running the examples and tests.
- [ ] Create a short presentation with a title, one section per concept, and a closing takeaway; do not add unrequested performance or compatibility claims.
- [ ] Mark Todo items complete only after the corresponding work and checks are done.

### Task 8: Final validation

**Files:**
- Read: all files under `lab-PHP/`
- Modify: `lab-PHP/Todo.md` only if a verified checklist entry needs correction.

- [ ] Run `Get-ChildItem .\lab-PHP\4.realisation -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName; if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE } }`; expect one `No syntax errors detected` result per PHP file and exit code 0.
- [ ] Run `php lab-PHP/4.realisation/tests/run.php`; expect all three named checks to print `PASS` and exit code 0; read the complete output.
- [ ] Verify `README.md`, `Todo.md`, all requested stage folders, official-source citations, and the final report/presentation.
- [ ] Run `git diff --check`; expect no whitespace errors. Confirm changes are limited to `lab-PHP/` and the approved design/plan documents, preserving the existing presentation edit.
