let rollsLeft = 3;
const dices = document.querySelector(".dices");

function gameStart() {
	const rollsElem = document.querySelector(".rollsLeft");
	if (rollsElem) rollsElem.innerText = rollsLeft;
}

function roll() {
	if (rollsLeft <= 0) return;

	let nbList = [];
	dices.querySelectorAll(".dice").forEach((dice) => {
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
		nbList.push(nb);
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

	["ones", "twos", "threes", "fours", "fives", "sixes"].forEach((id, i) => {
		const value = i + 1;
		document.querySelector(`#${id} .score`).textContent = `(${
			nbList.filter((nb) => nb === value).length * value
		})`;
	});
	((
		counts = Array.from(
			{ length: 6 },
			(_, i) => nbList.filter((nb) => nb === i + 1).length
		)
	) => {
		document.querySelector("#threeOfAKind .score").textContent = `(${(() => {
			const idx = counts.findIndex((c) => c >= 3);
			return idx !== -1 ? (idx + 1) * 3 : 0;
		})()})`;
		document.querySelector("#fourOfAKind .score").textContent = `(${(() => {
			const idx = counts.findIndex((c) => c >= 4);
			return idx !== -1 ? (idx + 1) * 4 : 0;
		})()})`;
		document.querySelector("#fullHouse .score").textContent = `(${
			counts.includes(3) && counts.includes(2) ? 25 : 0
		})`;

		const sorted = [...new Set(nbList)].sort((a, b) => a - b);
		[4, 5].forEach((n) => {
			document.querySelector(
				`#${n === 4 ? "small" : "large"}Straight .score`
			).textContent = `(${(() => {
				for (let i = 0; i <= sorted.length - n; i++) {
					if (sorted.slice(i, i + n).every((v, idx) => v === sorted[i] + idx))
						return n === 4 ? 30 : 40;
				}
				return 0;
			})()})`;
		});
		document.querySelector("#yamsy .score").textContent = `(${
			counts.includes(5) ? 50 : 0
		})`;
		document.querySelector("#chance .score").textContent = `(${nbList.reduce(
			(sum, nb) => sum + nb,
			0
		)})`;
	})();

	rollsLeft--;
	const rollsLeftText = document.querySelector(".rollsLeft");
	if (rollsLeftText) rollsLeftText.innerText = rollsLeft;
	const rollButton = document.getElementById("rollButton");
	rollButton.lastChild.textContent =
		rollsLeft == 3 ? `Roll Dice` : `Re-roll (${rollsLeft})`;
	if (rollsLeft == 0) rollButton.disabled = true;
}

document.addEventListener("DOMContentLoaded", gameStart);
