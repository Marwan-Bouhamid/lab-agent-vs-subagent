---
marp: true
theme: default
size: 16:9
paginate: true
---

<!-- _class: lead -->

# Agent vs Sub-agent
## Simple comparison

- Apprenant: Marwan bouhamid
- Encadrant: ES-SARRAJ FOUAD

<!--
This is the big idea.
A principal agent can act alone or delegate.
We explain the difference with a real example.
-->

---

## Plan


- what is agent and subagent
- When to delgate?
- Real demo
- Deferent between agent and subagent


---

## 1. Two roles

### Agent
- gets the goal
- chooses tools
- keeps the final answer

### Sub-agent
- gets a limited task
- works in a narrow scope
- returns a result

<!--
The agent owns the objective.
The sub-agent handles a smaller piece.
The principal checks the outcome.
-->

---


## 2. When to delegate?

### Keep it with the agent
- short task
- one continuous analysis

### Delegate it
- specialized task
- clear boundary
- easy to verify

<!--
Small and connected work stays local.
Large and specialized work can be delegated.
The principal remains responsible.
-->

---

## 3. Real demo

**Principal**
- `demo-orchestrator`

**Specialists**
- `official-docs-researcher`
- `focused-code-reviewer`

<!--
We used one principal agent and two specialists.
Each had one clear job.
The principal combined the outputs.
-->

---

## 4. Verified result

| Input | Before | After |
|---|---:|---:|
| `[80, 81]` | `81` | `80.5` |

**PASS**

<!--
The review sub-agent found the rounding bug.
The test then passed after the fix.
This was observed in a real run.
-->

---

## 6. Sources

- Claude Code — subagents
- OpenAI Agents SDK — agents, handoffs, tools
- CrewAI — agents, tasks, processes
- GitHub Copilot CLI — custom agents

<!--
These are the official references used in the lab.
We only claim what the docs support.
This is the basis for the comparison.
-->