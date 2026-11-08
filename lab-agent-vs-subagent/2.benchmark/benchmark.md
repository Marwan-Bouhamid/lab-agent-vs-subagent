---
marp: true
theme: default
size: 16:9
paginate: true
---

<!-- _class: lead -->

# Agent or sub-agent?
## Benchmark of three documented implementations

**Comparison:** Claude Code · OpenAI Agents SDK · CrewAI  
**Sources:** official documentation consulted on November 7, 2026

> Descriptive claims are **documented facts (F)**. Guidance on choice is **interpretation (I)**. Elements that require a test are **hypotheses (H)**.

---

## 1. The same word does not mean the same thing everywhere

| Implementation | What the documentation describes |
|---|---|
| **Claude Code** | A sub-agent is a specialized assistant to which Claude delegates a task. It works in its own context and returns a result. **F [C1]** |
| **OpenAI Agents SDK** | An agent is an LLM with instructions, tools, and configurable execution behaviors. Agents can hand off control or be called as tools. **F [O1, O2]** |
| **CrewAI** | An agent has a role and an objective; a task is assigned to it inside a “crew” that organizes the work. **F [R1, R2, R3]** |

**Working definition for this lab (I):** “sub-agent” here means a specialized agent invoked by a principal agent to perform a bounded task. This is not a universal definition across all frameworks.

---

## 2. Context: isolated, shared, or unspecified?

| Claude Code | OpenAI Agents SDK | CrewAI |
|---|---|---|
| The sub-agent has its own context window and returns its result to the principal agent. **F [C1]** | The reviewed pages describe agents, handoffs, and input filtering, but they do not establish that a specialized agent has an isolated context window. **Not verified [O1, O3]** | Tasks can use the output of other tasks as context; `respect_context_window` concerns the management of message size. An isolated window per agent is not established by the reviewed pages. **F / not verified [R1, R2]** |

**Takeaway (I):** “multiple agents” is not enough to prove a separation of context. We need to verify what is passed to each agent.

---

## 3. How is delegation organized?

| Claude Code | OpenAI Agents SDK | CrewAI |
|---|---|---|
| Claude can choose a sub-agent from its description and delegate a task to it. **F [C1]** | **Agent-as-tool:** the manager keeps the conversation and calls a specialist. **Handoff:** the specialist becomes the active agent. **F [O2, O3]** | `allow_delegation` controls delegation for an agent and defaults to `False`. A hierarchical process delegates distribution to the manager. **F [R1, R3]** |

**Example (I):** the principal keeps the final synthesis; it can delegate research to one specialist and review to another.

---

## 4. Tools and permissions

| Claude Code | OpenAI Agents SDK | CrewAI |
|---|---|---|
| Custom sub-agents can have tools and permissions defined separately. Integrated sub-agents inherit permission rules from the parent; most have fewer tools. **F [C1]** | Tools are configured on agents; handoffs can filter input elements. The reviewed pages do not specify a general permission isolation boundary between agents. **F / not verified [O1, O3, O4]** | Tools can be configured for the agent or limited to a task. The reviewed pages do not describe a permission boundary at the operating-system level. **F / not verified [R1, R2]** |

**Practical question (I):** does the specialist only have the tools needed for its task?

---

## 5. Parallelism: do not confuse “multiple” with “simultaneous”

| Claude Code | OpenAI Agents SDK | CrewAI |
|---|---|---|
| The documentation distinguishes sub-agents, which work in the same session, from background agents and agent teams. Parallelism of multiple sub-agents in the same call is not established by the page reviewed. **F / not verified [C1]** | Code orchestration can launch multiple agents in parallel, for example with `asyncio.gather`, when tasks are independent. **F [O2]** | A task can be marked `async_execution`. The reviewed pages do not provide a comparative time measurement. **F / not verified [R2, R3]** |

**Hypothesis to test (H):** two independent tasks—finding sources and reviewing code—could finish faster in parallel.

---

## 6. Token cost: no comparable value is inferred

| Claude Code | OpenAI Agents SDK | CrewAI |
|---|---|---|
| Sub-agent requests count toward the same usage limits as the main conversation. A cheaper model may be chosen. The page does not provide a universal cost per delegation. **F [C1]** | The documentation says that code-based orchestration is more predictable in speed, cost, and performance than leaving the decision to the LLM; no token count per sub-agent is provided in the reviewed pages. **F / not verified [O2]** | The reviewed pages describe agents, tasks, and processes, but do not provide a comparable token cost per delegation. **Not verified [R1, R2, R3]** |

**Conclusion (I):** a delegated task adds inference work, but its exact cost depends on the model, inputs, outputs, and runtime. We must measure the chosen execution.

---

## 7. Documented use cases and limits

| Implementation | Documented use case | Limit or precaution |
|---|---|---|
| **Claude Code** | Isolate an exploration or research task that would add many results to the principal context. **F [C1]** | Sub-agents remain in a session and their requests count against usage limits. Do not confuse them with background agents or agent teams. **F [C1]** |
| **OpenAI Agents SDK** | Call a specialist for a sub-task while keeping a manager, or hand off to a specialist agent. **F [O2, O3]** | LLM-based orchestration is less deterministic than a flow decided by code; behavior must be observed and evaluated. **F [O2]** |
| **CrewAI** | Distribute sequential tasks or use a manager for a hierarchical organization. **F [R2, R3]** | Delegation must be enabled if desired; the hierarchical process requires a manager LLM or manager agent. **F [R1, R3]** |

---

## 8. Decision rule to keep

### Pedagogical interpretation (I)

**Keep the task in the principal agent** if it is short, strongly tied to the current context, or if the coordination would cost more than the work.

**Delegate** if the task is well bounded, specialized, verifiable separately, and its result is useful to the principal.

Before delegating, verify:

1. What exact result must come back?
2. Which files, information, and tools does the sub-agent need?
3. Is the work independent, and can it actually be parallel in the chosen tool?
4. How will the result be verified and the real cost measured?

> **Hypotheses for the realization (H, not yet verified):** a research task and a review task can be handled by two specialists; their synthesis will be easier to read if their missions and output formats are distinct.

---

## Official sources consulted

**Claude Code**
- [C1] [Create custom subagents](https://code.claude.com/docs/en/sub-agents)

**OpenAI Agents SDK**
- [O1] [Agents](https://openai.github.io/openai-agents-python/agents/)
- [O2] [Agent orchestration](https://openai.github.io/openai-agents-python/multi_agent/)
- [O3] [Handoffs](https://openai.github.io/openai-agents-python/handoffs/)
- [O4] [Tools](https://openai.github.io/openai-agents-python/tools/)

**CrewAI**
- [R1] [Agents](https://docs.crewai.com/en/concepts/agents)
- [R2] [Tasks](https://docs.crewai.com/en/concepts/tasks)
- [R3] [Processes](https://docs.crewai.com/en/concepts/processes)
- [R4] [Crews](https://docs.crewai.com/en/concepts/crews)

All of the pages above are official documentation, consulted on November 7, 2026. They support the benchmark claims, but they do not by themselves establish every possible runtime property. When a page does not prove a claim, the benchmark marks it as **not verified** instead of guessing.