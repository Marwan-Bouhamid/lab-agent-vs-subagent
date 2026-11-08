# Agent configuration for the lab

The demonstration targets GitHub Copilot CLI.

- The custom agent profiles live in [`../.github/agents/`](../.github/agents/), the repository location documented for Copilot CLI ([official documentation](https://docs.github.com/en/copilot/how-tos/copilot-cli/use-copilot-cli/invoke-custom-agents)).
- The skill usable by the CLI is in [`skills/agent-vs-subagent/`](./skills/agent-vs-subagent/).
- The reference specification is [`../3.spec-skill/agent-vs-subagent/SKILL.md`](../3.spec-skill/agent-vs-subagent/SKILL.md). The runtime copy should remain identical to this specification.

The CLI should not receive a token or key in repository files. Authentication is handled separately by GitHub Copilot CLI.