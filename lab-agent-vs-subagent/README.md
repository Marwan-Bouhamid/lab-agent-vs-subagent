# Lab: What is the difference between an agent and a sub-agent?

This lab helps explain how an agent can work alone or delegate part of a task to a sub-agent. It compares official documentation and then relies on a real run that was actually executed.

## 1. Role in the main project thread

- **Main project thread:** this repository is a self-contained teaching artifact; no other project thread is assumed.
- **Technical prototype:** a demonstration in which a principal agent delegates distinct tasks to at least two specialized sub-agents.
- **Problem solved:** differentiate the roles and choose when delegation is useful, taking into account context, capabilities, costs, and implementation-specific limits.

## 2. Methodological approach

- **Solutions compared:** the benchmark compares Claude Code sub-agents, the OpenAI Agents SDK, and CrewAI using their official documentation.
- **Our choice:** GitHub Copilot CLI is used for the demonstration because its documentation describes custom profiles and delegation to specialized sub-agents, and because two specialized profiles were successfully invoked in a real run. Choosing the demonstration runtime is not a claim that all solutions are equivalent.

## 3. AI tooling and skills

- **Specified skill:** `agent-vs-subagent` — helps decide whether a task should remain in the principal agent's context or be delegated to a sub-agent.
- **Tooling:** GitHub Copilot CLI, official documentation for the frameworks compared, and Node.js for the executable fixture.
- **Demo configuration:** custom profiles in `.github/agents/`, the skill in `.agents/skills/agent-vs-subagent/`, and the reproducible procedure in [`4.realisation/README.md`](./4.realisation/README.md).

## 4. Startup and validation

### Prerequisites

- A browser with access to the official documentation.
- Git to inspect and version the repository.
- Node.js and GitHub Copilot CLI installed and authenticated to replay the demonstration.
- Basic familiarity with the concepts of instruction, tool, and task delegated to an agent.

### Success criteria

- Explain simply the difference between a principal agent and a sub-agent, with an example, without AI or prompt support.
- Present a Marp benchmark comparing at least three real implementations against the announced criteria, with each technical claim sourced from official documentation consulted.
- Provide a `SKILL.md` with `name` and `description` fields and a clear decision method.
- Reproduce a real execution where the principal agent delegates to at least two specialized sub-agents; distinguish observations from hypotheses.
- Deliver a report and a Marp presentation with a title slide and exactly three simple oral-note sentences per slide.

## Progress

Follow the milestones and verification items in [`Todo.md`](./Todo.md). Any items that are not yet verified must remain clearly marked as such.

## Official sources already consulted

- OpenAI, [Agents — OpenAI Agents SDK](https://openai.github.io/openai-agents-python/agents/).
- Anthropic, [Create custom subagents — Claude Code](https://code.claude.com/docs/en/sub-agents).
- CrewAI, [Agents — CrewAI documentation](https://docs.crewai.com/en/concepts/agents).

The detailed benchmark and its sources are in [`2.benchmark/benchmark.md`](./2.benchmark/benchmark.md). The limits and non-verified items are explicitly called out there.