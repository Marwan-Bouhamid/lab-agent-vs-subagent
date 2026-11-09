# PHP concepts benchmark

This document uses the official PHP manual to explain the language behavior behind the examples. The task-tracker design and its test cases are teaching choices for this lab, not rules required by PHP.

## Namespace

A namespace gives classes and other named PHP elements a name scope. A class can be referred to by a short name inside a namespace or by its fully qualified name. This lets two classes use the short name `Task` while keeping different full names. In this lab, they are `PhpLab\Domain\Task` and `PhpLab\Reporting\Task`. [PHP manual: Using namespaces: Basics](https://www.php.net/manual/en/language.namespaces.basics.php)

**In this lab:** the namespace names organize the domain and reporting code. The small autoloader connects the `PhpLab\` name prefix to the source directory; that file-loading arrangement is a lab implementation choice.

## Trait

A trait is a PHP code-reuse mechanism. A class can use a trait to include its methods without inheriting from the trait or from another class. A trait is not a class that can be instantiated on its own. [PHP manual: Traits](https://www.php.net/manual/en/language.oop5.traits.php)

**In this lab:** `Task` and `Project` both use `HasTimestamps` for `createdAt()`, `updatedAt()`, and `markUpdated()`. The trait is used because these two classes need the same small behavior; PHP does not require this particular design.

## Errors and exceptions

`Throwable` is the common interface for objects that can be thrown and caught. It includes both `Exception` and `Error`. PHP's `Error` class represents errors that generally indicate programming mistakes; an exception can instead be used to represent a condition the application knows how to report or handle. A custom exception class can extend PHP's `Exception` hierarchy. [PHP manual: Throwable](https://www.php.net/manual/en/class.throwable.php), [Exception](https://www.php.net/manual/en/class.exception.php), and [Error](https://www.php.net/manual/en/class.error.php)

**In this lab:** a blank task title raises `InvalidArgumentException`, and looking up an unknown task raises the custom `TaskNotFoundException`. These are chosen examples of invalid input and a missing domain item, not an exhaustive error-handling policy.

## Converting a warning

`set_error_handler()` installs a user-defined handler and keeps the previous handler on an internal stack. PHP calls the handler even when the current `error_reporting()` setting masks a severity, so a handler can inspect the mask and return `false` for a severity it does not want to handle. Several fatal and compile-time errors cannot be handled by a user-defined handler. [PHP manual: set_error_handler()](https://www.php.net/manual/en/function.set-error-handler.php)

`ErrorException` is an exception type intended for representing an error as an exception. The PHP manual shows a custom error handler checking `error_reporting()` and then throwing an `ErrorException`. [PHP manual: ErrorException](https://www.php.net/manual/en/class.errorexception.php)

`trigger_error()` can generate user-level errors, and its error level must be from the `E_USER_*` family. [PHP manual: trigger_error()](https://www.php.net/manual/en/function.trigger-error.php)

**In this lab:** the test triggers one `E_USER_WARNING`. The handler converts it only when its severity is enabled, returns `false` for the masked case, and is then removed so the previous handler is restored. This narrow demonstration does not claim that every PHP error can be converted or safely recovered from.

## Official sources

- [Using namespaces: Basics](https://www.php.net/manual/en/language.namespaces.basics.php)
- [Traits](https://www.php.net/manual/en/language.oop5.traits.php)
- [Throwable](https://www.php.net/manual/en/class.throwable.php)
- [Exception](https://www.php.net/manual/en/class.exception.php)
- [Error](https://www.php.net/manual/en/class.error.php)
- [set_error_handler()](https://www.php.net/manual/en/function.set-error-handler.php)
- [ErrorException](https://www.php.net/manual/en/class.errorexception.php)
- [trigger_error()](https://www.php.net/manual/en/function.trigger-error.php)
