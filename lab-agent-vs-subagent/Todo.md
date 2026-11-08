# Todo — Agent vs Subagent Lab

## Scope and workflow
- [x] Review the reference repository and summarize its logic in 10 lines.
- [x] Validate the understanding and the start of the lab.

## Dossier 1 — Need
- [x] Define the terms “agent” and “sub-agent” using official sources.
- [x] Formulate the lab question and its scope.
- [x] Define verifiable success criteria.

## Root
- [x] Write `README.md` according to the requested structure.

## Dossier 2 — Benchmark
- [x] Consult the official documentation of at least three implementations.
- [x] Compare the eight requested dimensions and cite each technical claim.
- [x] Create the Marp presentation and separate documented facts, interpretations, and hypotheses.

## Dossier 3 — Skill specification
- [x] Consult the official Anthropic guidance and the Agent Skills specification.
- [x] Run three basic decision cases without the skill.
- [x] Create `3.spec-skill/agent-vs-subagent/SKILL.md` with the required frontmatter.
- [x] Replay the three cases with the skill; verify conditional delegation, principal-agent handling, and no delegation for continuous analysis.

## Dossier 4 — Realization
- [x] Choose Copilot CLI and verify its documented prerequisites (CLI installed, custom profiles available, and `--fleet` mode working).
- [x] Authenticate GitHub Copilot CLI (OAuth accepted; no secrets stored in the repository).
- [x] Configure the principal agent and the two specialized profiles under `.github/agents/`.
- [x] Add the review case and verify the test before and after the fix.
- [x] Run the demonstration for real; confirm that both specialized profiles were invoked and retain their results.
- [x] Document the reproducible steps, limits, and any non-verified data.

## Dossier 5 — Report and presentation
- [x] Write the report based on the sources and the results actually obtained.
- [x] Create a Marp presentation with a title slide and exactly three simple oral-note sentences per slide.
- [x] Verify the Marp rendering, note count, and clarity of the presentation for an explanation without AI or prompts.