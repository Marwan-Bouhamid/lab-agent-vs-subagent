# Realization — delegate, review, verify

This demonstration shows a principal agent assigning two independent tasks to two specialized profiles. The review case is a small average function: a test reveals a defect, a sub-agent identifies it, and the test is re-run after the fix.

## Choice of tool

The demonstration uses GitHub Copilot CLI. Its official documentation describes custom profiles in `.github/agents/`, their invocation through `--agent`, and the possibility for the model to delegate to a specialized sub-agent process:
[Invoking custom agents](https://docs.github.com/en/copilot/how-tos/copilot-cli/use-copilot-cli/invoke-custom-agents).

The local version used was `GitHub Copilot CLI 1.0.105`. Its local help describes `--fleet` as the parallel orchestration mode for sub-agents. The official documentation also explains that `--available-tools` limits the tools shown to the model and that `--allow-tool` authorizes tools for the current session:
[Allowing and denying tool use](https://docs.github.com/en/copilot/how-tos/copilot-cli/use-copilot-cli/allowing-tools).

## Files

- [`../.github/agents/demo-orchestrator.agent.md`](../.github/agents/demo-orchestrator.agent.md) — principal agent responsible for distributing tasks and synthesizing the results.
- [`../.github/agents/official-docs-researcher.agent.md`](../.github/agents/official-docs-researcher.agent.md) — limited to research on the benchmark claims and links from the README.
- [`../.github/agents/focused-code-reviewer.agent.md`](../.github/agents/focused-code-reviewer.agent.md) — read-only review of the function against the brief.
- [`fixtures/brief.md`](./fixtures/brief.md) — requirements for the case.
- [`fixtures/average-score.mjs`](./fixtures/average-score.mjs) — fixed function.
- [`fixtures/verify.mjs`](./fixtures/verify.mjs) — executable verification for the two cases.

The profiles are limited to `view`, `grep`, and `glob` for inspection. The principal also needs `task` to delegate. The command explicitly restricts the available tools; it does not enable the full tool set.

## Prerequisites

- Node.js; verified here with `v22.20.0`.
- GitHub Copilot CLI; verified here with `1.0.105`.
- Active GitHub Copilot CLI authentication.
- Run the commands from the root `lab-agent-vs-subagent/` folder.

## Reproduce

### 1. Observe the defect, then verify the correction

Before the fix, the test failed with `81 !== 80.5` for `[80, 81]`. The review sub-agent identified the rounding as the cause. After replacing the rounding with the exact mean:

```powershell
node .\4.realisation\fixtures\verify.mjs
```

Observed result:

```text
PASS: averageScore satisfies the two brief cases.
```

The test verifies `[80, 81] -> 80.5` and `[] -> null`.

### 2. Run the delegation

After authentication, from the lab root:

```powershell
copilot --agent demo-orchestrator --fleet --prompt "Run the demonstration now. Delegate two independent tasks, one to @official-docs-researcher and one to @focused-code-reviewer. Do not do their specialized analysis yourself. Wait for both reports, then provide a brief synthesis that distinguishes documented facts, interpretation, and not verified. In the report, identify each sub-agent and its result separately, state whether each was actually called, and summarize the principal's specific role. For the review, inspect the fixture against the brief, especially [80, 81] and []. Search only in the benchmark and README as requested by the profile. Do not modify any files and do not run any commands." --allow-tool task view grep glob --available-tools task view grep glob --trust-folder --output-format text
```

`--trust-folder` authorizes the folder configuration only for this prompt session; the listed tool permissions are not added to a persistent allowlist. Authentication is not included in the files of the lab.

## Real results actually observed

During execution with Copilot CLI 1.0.105:

1. **`@official-docs-researcher` was called.** It examined the benchmark and the README, then summarized the official claims and links contained there. It explicitly stated that it did not open the source pages during this run: its findings are therefore attributions read from the benchmark, not a fresh verification of the pages.
2. **`@focused-code-reviewer` was called.** It reported that `Math.round` returns `81` for `[80, 81]` instead of `80.5`, and that `[]` returns `null`, as required. The review was done in read-only mode.
3. **The principal synthesized both reports.** It distinguished the research finding, the concrete defect reported by the reviewer, and the limits of verification. The CLI output confirmed that both sub-agents returned a report.
4. **Local verification:** the test first failed on the decimal case, then passed after the fix, with the `PASS` message above.

The first CLI attempt did not delegate: `read` was not a recognized tool name in this version and `task` was absent from the allowlist. The profiles and command were adjusted (`view` for reading, `task` for delegation), and then the run described above invoked both specialists.

## Facts, interpretation, and limits

- **Observed fact:** the two named profiles were invoked in this run and returned reports; the test failed before the fix and succeeded after it.
- **Interpretation:** separating the tasks made the code defect easier to spot and the synthesis easier to read. This is a pedagogical observation from one example, not a comparative measurement.
- **Not verified:** the cost per sub-agent, the split of tokens between them, the degree of context isolation for their profiles, and the time gain from parallelism. The CLI report does not provide measures attributable to each specialist.
- **Scope limitation:** the research sub-agent did not reload the documentation sites during this run. The benchmark sources had been verified in the earlier work, but their content was not revalidated by this sub-agent.