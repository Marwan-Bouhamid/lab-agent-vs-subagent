# Three PHP concepts in a task tracker

## Namespaces

A namespace organizes a class name. This lab has a domain `Task` and a reporting `Task`. Their full names are different, so PHP can distinguish them.

## Traits

A trait shares methods between classes. `Task` and `Project` both use `HasTimestamps`. Neither class needs to inherit from the other to use those methods.

## Errors and exceptions

The task tracker rejects a blank title and reports an unknown task ID with exceptions. A controlled warning can become an `ErrorException` when it is enabled. A custom handler cannot handle every PHP error.

## Takeaway

Namespaces organize names, traits share behavior, and errors and exceptions make selected problems clear. Use the PHP manual to check the exact language behavior.
