# PHP concepts lab report

## Purpose

This lab studied three PHP concepts that are new to the course: namespaces, traits, and error and exception handling. The examples use one small task-tracker model.

## What each concept does

### Namespaces

Namespaces organize class names. The lab has a domain class named `PhpLab\Domain\Task` and a reporting class named `PhpLab\Reporting\Task`. They share the short name `Task`, but their full names are different. [PHP manual: Using namespaces: Basics](https://www.php.net/manual/en/language.namespaces.basics.php)

### Traits

A trait lets a class reuse methods without inheriting those methods from another class. `Task` and `Project` both use `HasTimestamps` for creation time, update time, and marking an update. A trait is not instantiated on its own. [PHP manual: Traits](https://www.php.net/manual/en/language.oop5.traits.php)

### Errors and exceptions

PHP's `Throwable` interface covers objects that can be thrown, including `Exception` and `Error`. The example uses an exception for a blank task title and a custom `TaskNotFoundException` for an unknown task ID. A controlled `E_USER_WARNING` is converted to `ErrorException` only when its severity is enabled. [PHP manual: Throwable](https://www.php.net/manual/en/class.throwable.php), [Error](https://www.php.net/manual/en/class.error.php), [Exception](https://www.php.net/manual/en/class.exception.php), and [ErrorException](https://www.php.net/manual/en/class.errorexception.php)

The custom warning handler checks `error_reporting()` and returns `false` for a masked warning. PHP's manual also explains that some fatal and compile-time errors cannot be handled by a user-defined handler. This lab does not claim that every PHP error can be converted or safely recovered from. [PHP manual: set_error_handler()](https://www.php.net/manual/en/function.set-error-handler.php)

## Observed test results

The tests were run with PHP 8.5.11 CLI.

Command:

```powershell
php lab-PHP/4.realisation/tests/run.php
```

Observed output:

```text
PASS: namespaced task classes load without a name collision.
PASS: both classes reuse and update timestamps.
PASS: expected exceptions and warning conversion are handled.
```

These results show that the three checks completed successfully in this local run. They do not measure performance or establish results on other PHP versions or environments.

## Conclusion

The task tracker shows three distinct uses: namespaces keep class names organized, a trait shares timestamp behavior, and exceptions plus a selected warning handler make certain failure cases explicit. The official PHP manual is the reference for language behavior; the task tracker is only a learning example.
