# Need — Agent and sub-agent

## 1. Subject and question

This lab aims to answer the following question:

> What is the difference between an agent and a sub-agent, and when does a principal agent benefit from delegating a task to a sub-agent?

The answer should not treat “agent” and “sub-agent” as universal terms with exactly the same meaning across all tools. The benchmark will specify what each implementation documents and then separate those facts from the pedagogical interpretation used in the lab.

## 2. Working definitions

### Agent

**Documented fact — OpenAI Agents SDK:** the documentation describes an agent as a language model configured with instructions, tools, and optional execution behaviors such as handoffs to other agents, guardrails, and structured outputs.

**Definition used in this lab:** an agent is an execution unit to which an objective is assigned, with instructions and capabilities defined. Depending on the system, this unit may act alone or participate in an orchestration.

### Sub-agent

**Documented fact — Claude Code:** the documentation presents sub-agents as specialized assistants to which a task can be delegated. They work in a separate context window, with a specific instruction and configurable tool access, and then return their result to the agent that launched them.

**Definition used in this lab:** a sub-agent is an agent called by a principal agent to perform a bounded, specialized task and then return a result. The phrase “sub-agent” refers here to this delegation relationship; its concrete properties (context, permissions, tools, cost) depend on the implementation.

### Simple summary

> An agent receives an objective and acts. A sub-agent receives a precise part of that objective because a principal agent delegates it. A sub-agent is therefore not defined by its name alone, but by its role in the workflow under study.

## 3. Problem and interest

When a task is long or composed of several different jobs, doing everything within the principal agent's conversation can mix goals and accumulate unnecessary information. Delegation can isolate a research task or a review task, but it also adds calls and result exchanges. The lab must therefore compare the benefits and costs instead of assuming that multiple agents are always preferable.

**Interpretation to test:** a sub-agent is relevant if its mission can be stated clearly, if its result is useful to the principal agent, and if the benefit of this separation justifies the additional cost.

## 4. Scope

### Included

- Distinguish the roles of principal agent and sub-agent.
- Compare execution context, delegation, tools and permissions, parallelism, token cost, use cases, and limitations.
- Study at least three real implementations using only their official documentation.
- Specify a skill that helps choose between handling a task in the principal agent or delegating it.
- Produce a reproducible demonstration in which a principal agent delegates to at least two specialized sub-agents.
- Present the real observations obtained during execution without replacing a test with an invented scenario.

### Out of scope

- Claim that one architecture or tool is better in all cases.
- Automatically equate a sub-agent with a process, a different model, or an independent session: these properties must be verified separately for each product.
- Present a token cost as measured when it was not actually recorded during a real run.

## 5. Lab success criteria

The lab will be considered successful when the following points are verifiable:

1. **Understanding:** the learner can explain simply the difference in role between a principal agent and a sub-agent and give a concrete example without AI or prompts.
2. **Benchmark:** a Marp slide deck compares at least three implementations using their official documentation; claims are sourced, and documented facts, interpretations, and hypotheses are clearly identified.
3. **Specification:** the folder contains a `SKILL.md` with frontmatter including `name` and `description`, plus guidance for deciding whether a task should stay with the principal agent or be delegated.
4. **Demonstration:** the configuration files and execution example make it possible to reproduce delegation from a principal agent to at least two specialized sub-agents.
5. **Results:** the observations presented come from a run that was actually executed; every non-verified datum is clearly marked as such.
6. **Defense:** the report and the Marp presentation include a title slide; every slide contains exactly three simple oral-note sentences.
7. **Traceability:** completed steps are checked in `Todo.md`, and uncompleted or unverified sections remain clearly marked.

## 6. Documented facts, interpretations, and hypotheses

| Type | Statement | Status |
|---|---|---|
| Documented fact | In the OpenAI Agents SDK, an agent is an LLM configured with instructions, tools, and optional execution behaviors. | Verified in the official documentation cited below. |
| Documented fact | In Claude Code, a sub-agent can be specialized, work in a separate context window, and return the result of a delegated task. | Verified in the official documentation cited below. |
| Interpretation | “Principal agent” and “sub-agent” describe roles in a delegation relationship for the needs of this lab. | Working definition; not to be confused with universal terminology. |
| Hypothesis | Splitting a research task and a review task could make them easier to process in parallel. | To be verified during the benchmark and demonstration; not yet verified. |
| Hypothesis | Delegation may improve readability of the principal context but increases the number of exchanges and total cost. | To be verified according to the implementation and observed execution; not yet verified. |

## 7. Official sources consulted

Consulted on **November 7, 2026**:

- OpenAI, [Agents — OpenAI Agents SDK](https://openai.github.io/openai-agents-python/agents/) — agent definition and configuration.
- Anthropic, [Create custom subagents — Claude Code](https://code.claude.com/docs/en/sub-agents) — specialization, separate context, delegation, and tool access for sub-agents.

These two sources serve only to establish the initial working definitions. The other comparisons required will be added to the benchmark after consulting the official documentation of each retained implementation.