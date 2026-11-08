---
name: agent-vs-subagent
description: Use when deciding whether an agent should handle a task itself or delegate it to a subagent, especially when task independence, context size, tools, permissions, parallelism, or token cost may affect the choice.
---

# Choosing an Agent or a Subagent

## Core principle

Choose by task shape and verified runtime behavior, not by the label an implementation uses. A subagent is useful only when its work can be bounded, its result can be checked, and delegation is worth the added coordination.

## Decision procedure

1. **Split the requested outcome into tasks.** Identify each task's inputs, expected result, and dependencies.
2. **Keep work in the principal agent** when it is small, tightly coupled to the current context, or part of one continuous analysis or change.
3. **Delegate a bounded task** when it is specialized, sufficiently independent, produces a clear result, and can be verified separately.
4. **Choose order deliberately.** Run tasks in parallel only when they do not depend on one another and the selected runtime documents or demonstrates parallel execution. Otherwise, pass the earlier result as input to the next task.
5. **Do not infer capabilities from the current chat's tools.** If the target runtime is unspecified, you may recommend delegation based on task shape, but mark concurrency and configuration as **not verified** and ask which runtime is intended before promising a runnable setup.
6. **Check the selected runtime's documentation** before claiming that agents have isolated context, restricted tools or permissions, can run concurrently, or reduce token cost. If the documentation or an observed run does not establish a property, report it as **not verified**.
7. **Keep the principal accountable for the final result.** It checks delegated outputs, resolves conflicts, and answers the user.

## Decision output

For a decision that needs to be explained, report:

- **Choice:** principal agent, delegate, or insufficient information.
- **Reason:** how task size, coupling, specialization, and verification affect the choice.
- **Delegation contract:** the bounded task, required inputs, permitted tools or sources, and expected output.
- **Runtime checks:** which properties are documented or observed, and which remain not verified.
- **Integration:** how the principal will verify and use the returned result.

If a missing runtime fact would change the decision, state what is unknown and ask for the implementation or its documentation instead of guessing.

## Examples

- **Delegate:** A large documentation search and an independent code review can go to separate specialists. The principal compares their bounded reports and writes the final response. Parallel execution is conditional on runtime support.
- **Keep in the principal:** Renaming a variable and updating its adjacent assertion in the same small file is one tightly coupled change; delegation adds coordination without a clear benefit.
- **Keep one continuous analysis together:** If a conclusion depends on comparing log entries directly with changes in a diff, do not split the comparison unless the runtime and handoff contract preserve the necessary evidence.

## Common mistakes

- Treating every framework's “agent” or “subagent” as the same architecture.
- Assuming that a separate agent means a separate context window or permission boundary.
- Calling work parallel because it uses multiple agents.
- Claiming lower token cost without measuring usage or citing runtime-specific evidence.
- Delegating without a precise input, expected output, or way to verify the result.

## References

- Anthropic, [Agent Skills overview](https://platform.claude.com/docs/en/agents-and-tools/agent-skills/overview) — skill metadata and progressive disclosure.
- Agent Skills, [Specification](https://agentskills.io/specification) — required `name` and `description` fields and directory naming.
- Anthropic, [Claude Code subagents](https://code.claude.com/docs/en/sub-agents) — implementation-specific behavior; do not generalize it to other runtimes.
