# Report — What is the difference between an agent and a sub-agent?

## Summary

An agent receives an objective and acts with defined instructions and capabilities. A sub-agent is an agent to which a principal agent delegates a specific part of the work, and whose result it then verifies and reuses. This definition describes a **working relationship for this lab**; it does not guarantee that every tool gives sub-agents the same context, the same permissions, or the same execution mode.

The benchmark and the demonstration show why these properties must be checked for each implementation. A short task that is tightly coupled to context can remain with the principal agent. A specialized, bounded, and separately verifiable task can be delegated if the expected benefit justifies the extra coordination.

## Question and method

The lab answers the question: **when should the principal agent handle a task itself, and when is it beneficial to delegate it?**

The benchmark compares Claude Code, the OpenAI Agents SDK, and CrewAI based on their official documentation. It distinguishes **documented facts (F)** from **pedagogical interpretations (I)**. A capability not established by the pages consulted is marked **not verified**, rather than inferred from the product name alone.

## Benchmark results

| Implementation | Delegation and context | Tools, parallelism, and cost |
|---|---|---|
| **Claude Code** | A specialized sub-agent receives a task and works in its own context before returning a result. **F [C1]** | Tools and permissions can be configured for sub-agents. The docs distinguish sub-agents from background agents and agent teams; they do not establish here that multiple sub-agents in the same call execute in parallel. The exact cost of delegation is not fixed. **F / not verified [C1]** |
| **OpenAI Agents SDK** | A specialist agent can be called as a tool or receive control through a handoff. **F [O2, O3]** | Tools are configurable. Code-based orchestration can run independent agents in parallel; an isolated context window per agent is not established by the pages reviewed. No comparable token cost per sub-agent is provided. **F / not verified [O1, O2, O4]** |
| **CrewAI** | Tasks can be organized in sequential or hierarchical processes, with a manager in the latter case. **F [R2, R3]** | Delegation must be enabled when needed; tasks can be asynchronous. The reviewed pages do not establish either an isolated context per agent or a comparable token cost for delegation. **F / not verified [R1, R2, R3]** |

**Interpretation (I):** “multiple agents” alone does not prove context isolation, parallelism, or lower cost. We need to check how the runtime passes information and measure the chosen execution.

## Produced skill

The `agent-vs-subagent` skill proposes a four-step decision: split the expected outcome into tasks; keep short, tightly coupled, or continuous work with the principal agent; delegate a specialized, bounded, and verifiable task; only run tasks in parallel if they are independent and the selected runtime allows it. The principal remains responsible for checking the results and producing the final response.

## Demonstration and observations

The implementation uses GitHub Copilot CLI 1.0.105, with one principal profile and two specialized profiles. The Copilot CLI documentation places repository custom agents in `.github/agents/` and describes the ability to delegate to a specialized sub-agent process [G1]. The command used for the run, the profiles, and the limitations are described in [`4.realisation/README.md`](../4.realisation/README.md).

During the real execution in `--fleet` mode, both profiles were invoked:

- `official-docs-researcher` reviewed the claims and links in the benchmark and README. It clarified that it did not open the source pages during this run: it verified the attributions already present in the repository, not the live content of the sites again.
- `focused-code-reviewer` compared the `averageScore` function against the brief. It found that `[80, 81]` returned `81` instead of `80.5`, while `[]` correctly returned `null`.
- `demo-orchestrator` combined the reports and stated the limitations. It did not modify any file or run any command.

The fixture test observed the failure `81 !== 80.5` before the fix. After removing the rounding, the command `node .\4.realisation\fixtures\verify.mjs` displayed `PASS: averageScore respects the two brief cases.` The CLI session report showed **0.35 AI Credits for the entire run**; this value is not broken down per sub-agent and does not allow us to infer the cost of each one.

## Conclusion and limitations

**Observed facts:** the run invoked both specialized profiles; the reviewer identified the decimal-case defect; the test passed after the fix. **Interpretation:** two distinct specialized tasks made the example easier to read and review. This is not an experimental comparison against a single agent.

The following remain **not verified**: the time gain from parallelism, the actual degree of context isolation between the two profiles in this run, and the split of tokens or credits per sub-agent. The local CLI help describes `--fleet` as parallel orchestration, but no comparative execution time was measured. The researcher in the demonstration did not reload the official sites.

## Official sources

**Benchmark**

- [C1 — Claude Code: Create custom subagents](https://code.claude.com/docs/en/sub-agents)
- [O1 — OpenAI Agents SDK: Agents](https://openai.github.io/openai-agents-python/agents/)
- [O2 — OpenAI Agents SDK: Agent orchestration](https://openai.github.io/openai-agents-python/multi_agent/)
- [O3 — OpenAI Agents SDK: Handoffs](https://openai.github.io/openai-agents-python/handoffs/)
- [O4 — OpenAI Agents SDK: Tools](https://openai.github.io/openai-agents-python/tools/)
- [R1 — CrewAI: Agents](https://docs.crewai.com/en/concepts/agents)
- [R2 — CrewAI: Tasks](https://docs.crewai.com/en/concepts/tasks)
- [R3 — CrewAI: Processes](https://docs.crewai.com/en/concepts/processes) and [Crews](https://docs.crewai.com/en/concepts/crews)

**Implementation and presentation**

- [G1 — GitHub Copilot CLI: Invoking custom agents](https://docs.github.com/en/copilot/how-tos/copilot-cli/use-copilot-cli/invoke-custom-agents)
- [G2 — GitHub Copilot CLI: Allowing and denying tool use](https://docs.github.com/en/copilot/how-tos/copilot-cli/use-copilot-cli/allowing-tools)
- [M1 — Marpit: Presenter notes](https://marpit.marp.app/usage?id=presenter-notes)

The benchmark and Copilot CLI sources were consulted during the lab work. The Marpit page documents the syntax of notes in HTML comments; it is not a source about agent behavior.
