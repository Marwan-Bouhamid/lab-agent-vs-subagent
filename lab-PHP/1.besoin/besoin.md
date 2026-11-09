# Learning need

## Question

How can PHP code keep class names organized, share useful methods between classes, and respond clearly when something goes wrong?

## Scope

This lab introduces three PHP concepts that have not yet been studied in class:

- **Namespaces:** organize names and allow classes with the same short name to be kept separate.
- **Traits:** share a small group of methods between classes without making one class inherit from another.
- **Errors and exceptions:** detect problems, report them with useful types, and handle a selected warning in a controlled way.

The examples use a small task tracker. Its domain `Task` and reporting `Task` demonstrate namespaces. `Task` and `Project` share timestamp methods through a trait. A task board demonstrates invalid input, a missing task, and conversion of an enabled warning into an exception.

## Prerequisites

The learner should be able to read basic PHP syntax, variables, functions, arrays, and simple classes. The lab explains the class and object ideas needed for its examples.

## Non-goals

- Build a web application, database, or production task-management system.
- Convert every PHP error into an exception or claim every error can be recovered from.
- Treat a trait as a class that can be instantiated by itself.
- Replace official PHP documentation with this lab's simplified explanations.

## Observable success criteria

At the end of the lab, the learner can:

1. Explain in simple words what each of the three concepts is for.
2. Identify why the two `Task` classes have different fully qualified names.
3. Show how `Task` and `Project` use the shared timestamp methods.
4. Describe the difference between the lab's invalid-task exception and its converted warning.
5. Run the native PHP test command and explain what each passing check demonstrates.
