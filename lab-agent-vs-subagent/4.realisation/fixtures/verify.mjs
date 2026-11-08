import assert from "node:assert/strict";
import { averageScore } from "./average-score.mjs";

assert.equal(averageScore([80, 81]), 80.5);
assert.equal(averageScore([]), null);

console.log("PASS: averageScore respecte les deux cas du brief.");
