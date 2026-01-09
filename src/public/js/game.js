let rollsLeft = 3;

function gameStart() {
	const rollsElem = document.querySelector(".rollsLeft");
	if (rollsElem) rollsElem.innerText = rollsLeft;
}

function roll() {
	if (rollsLeft <= 0) return;

	document.querySelectorAll(".dices .dice").forEach((dice) => {
		dice.style.backgroundColor = "var(--color-primary)";

		const tl = dice.querySelector(".dot.top-left");
		const tc = dice.querySelector(".dot.top-center");
		const tr = dice.querySelector(".dot.top-right");
		const ml = dice.querySelector(".dot.middle-left");
		const mc = dice.querySelector(".dot.middle-center");
		const mr = dice.querySelector(".dot.middle-right");
		const bl = dice.querySelector(".dot.bottom-left");
		const bc = dice.querySelector(".dot.bottom-center");
		const br = dice.querySelector(".dot.bottom-right");

		const nb = Math.floor(Math.random() * 6) + 1;

		switch (nb) {
			case 1:
				tl && (tl.style.opacity = "0");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "0");
				ml && (ml.style.opacity = "0");
				mc && (mc.style.opacity = "1");
				mr && (mr.style.opacity = "0");
				bl && (bl.style.opacity = "0");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "0");
				break;
			case 2:
				tl && (tl.style.opacity = "1");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "0");
				ml && (ml.style.opacity = "0");
				mc && (mc.style.opacity = "0");
				mr && (mr.style.opacity = "0");
				bl && (bl.style.opacity = "0");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "1");
				break;
			case 3:
				tl && (tl.style.opacity = "1");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "0");
				ml && (ml.style.opacity = "0");
				mc && (mc.style.opacity = "1");
				mr && (mr.style.opacity = "0");
				bl && (bl.style.opacity = "0");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "1");
				break;
			case 4:
				tl && (tl.style.opacity = "1");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "1");
				ml && (ml.style.opacity = "0");
				mc && (mc.style.opacity = "0");
				mr && (mr.style.opacity = "0");
				bl && (bl.style.opacity = "1");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "1");
				break;
			case 5:
				tl && (tl.style.opacity = "1");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "1");
				ml && (ml.style.opacity = "0");
				mc && (mc.style.opacity = "1");
				mr && (mr.style.opacity = "0");
				bl && (bl.style.opacity = "1");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "1");
				break;
			case 6:
				tl && (tl.style.opacity = "1");
				tc && (tc.style.opacity = "0");
				tr && (tr.style.opacity = "1");
				ml && (ml.style.opacity = "1");
				mc && (mc.style.opacity = "0");
				mr && (mr.style.opacity = "1");
				bl && (bl.style.opacity = "1");
				bc && (bc.style.opacity = "0");
				br && (br.style.opacity = "1");
				break;
		}
	});

	document.querySelectorAll(".outlined .game-grid button").forEach((btn) => {
		btn.disabled = false;
	});

	rollsLeft--;
	const rollsLeftText = document.querySelector(".rollsLeft");
	if (rollsLeftText) rollsLeftText.innerText = rollsLeft;
	const rollButton = document.getElementById("rollButton");
	rollButton.lastChild.textContent =
		rollsLeft == 3 ? `Roll Dice` : `Re-roll (${rollsLeft})`;
	if (rollsLeft == 0) rollButton.disabled = true;
}

document.addEventListener("DOMContentLoaded", gameStart);
