let rollsLeft = 3;
const dices = document.querySelector(".dices");
const playerCards = document.querySelectorAll(".player-cards .card-col");
const rollButton = document.getElementById("rollButton");

function gameStart() {
	document.querySelector(".rollsLeft").innerText = rollsLeft;

	dices.querySelectorAll(".dice").forEach((dice) => {
		dice.addEventListener("click", () => {
			if (rollsLeft < 3) {
				dice.classList.toggle("selected");
				checkRollButton();
			}
		});
	});

	document.querySelectorAll(".game-grid button").forEach((btn) => {
		btn.addEventListener("click", () => selectScore(btn));
	});
}

function roll() {
	if (rollsLeft <= 0) return;

	let nbList = [];
	dices.querySelectorAll(".dice").forEach((dice) => {
		if (rollsLeft === 3 || !dice.classList.contains("selected")) {
			dice.classList.remove("selected", "initial");
			dice.style.backgroundColor = "var(--color-primary)";

			const nb = Math.floor(Math.random() * 6) + 1;
			dice.dataset.value = nb;
			nbList.push(nb);
			renderDice(dice, nb);
		} else nbList.push(parseInt(dice.dataset.value) || 1);
	});

	document
		.querySelectorAll(".outlined .game-grid button")
		.forEach((btn) => (btn.disabled = false));

	calculateScores(nbList);

	rollsLeft--;
	document.querySelector(".rollsLeft").innerText = rollsLeft;
	document.getElementById("rollButton").lastChild.textContent =
		rollsLeft === 3 ? `Roll Dice` : `Re-roll (${rollsLeft})`;
	checkRollButton();
}

function renderDice(dice, value) {
	const dots = {
		tl: dice.querySelector(".dot.top-left"),
		tc: dice.querySelector(".dot.top-center"),
		tr: dice.querySelector(".dot.top-right"),
		ml: dice.querySelector(".dot.middle-left"),
		mc: dice.querySelector(".dot.middle-center"),
		mr: dice.querySelector(".dot.middle-right"),
		bl: dice.querySelector(".dot.bottom-left"),
		bc: dice.querySelector(".dot.bottom-center"),
		br: dice.querySelector(".dot.bottom-right"),
	};

	const patterns = {
		1: ["mc"],
		2: ["tl", "br"],
		3: ["tl", "mc", "br"],
		4: ["tl", "tr", "bl", "br"],
		5: ["tl", "tr", "mc", "bl", "br"],
		6: ["tl", "tr", "ml", "mr", "bl", "br"],
	};

	Object.values(dots).forEach((dot) => dot && (dot.style.opacity = "0"));
	patterns[value].forEach(
		(key) => dots[key] && (dots[key].style.opacity = "1")
	);
}

function calculateScores(nbList) {
	const counts = Array.from(
		{ length: 6 },
		(_, i) => nbList.filter((nb) => nb === i + 1).length
	);

	["ones", "twos", "threes", "fours", "fives", "sixes"].forEach((id, i) => {
		const btn = document.querySelector(`#${id}`);
		if (!btn.classList.contains("played")) {
			btn.querySelector(".score").textContent = `(${counts[i] * (i + 1)})`;
		}
	});

	const threeBtn = document.querySelector("#threeOfAKind");
	if (!threeBtn.classList.contains("played")) {
		threeBtn.querySelector(".score").textContent = `(${
			(counts.findIndex((c) => c >= 3) + 1) * 3
		})`;
	}

	const fourBtn = document.querySelector("#fourOfAKind");
	if (!fourBtn.classList.contains("played")) {
		fourBtn.querySelector(".score").textContent = `(${
			(counts.findIndex((c) => c >= 4) + 1) * 4
		})`;
	}

	const fullHouseBtn = document.querySelector("#fullHouse");
	if (!fullHouseBtn.classList.contains("played")) {
		fullHouseBtn.querySelector(".score").textContent = `(${
			counts.includes(3) && counts.includes(2) ? 25 : 0
		})`;
	}

	const sorted = [...new Set(nbList)].sort((a, b) => a - b);
	const hasConsecutive = (n) => {
		for (let i = 0; i <= sorted.length - n; i++) {
			if (sorted.slice(i, i + n).every((v, idx) => v === sorted[i] + idx))
				return true;
		}
		return false;
	};

	const smallStraightBtn = document.querySelector("#smallStraight");
	if (!smallStraightBtn.classList.contains("played")) {
		smallStraightBtn.querySelector(".score").textContent = `(${
			hasConsecutive(4) ? 30 : 0
		})`;
	}

	const largeStraightBtn = document.querySelector("#largeStraight");
	if (!largeStraightBtn.classList.contains("played")) {
		largeStraightBtn.querySelector(".score").textContent = `(${
			hasConsecutive(5) ? 40 : 0
		})`;
	}

	const yamsyBtn = document.querySelector("#yamsy");
	if (!yamsyBtn.classList.contains("played")) {
		yamsyBtn.querySelector(".score").textContent = `(${
			counts.includes(5) ? 50 : 0
		})`;
	}

	const chanceBtn = document.querySelector("#chance");
	if (!chanceBtn.classList.contains("played")) {
		chanceBtn.querySelector(".score").textContent = `(${nbList.reduce(
			(sum, nb) => sum + nb,
			0
		)})`;
	}
}

function checkRollButton() {
	const selectedCount = dices.querySelectorAll(".dice.selected").length;
	rollButton.disabled = selectedCount === 5 || rollsLeft === 0;
}

function selectScore(btn) {
	if (btn.disabled || btn.classList.contains("played")) return;

	const activeCard = document.querySelector(".card-col.outlined");
	if (!activeCard || !activeCard.contains(btn)) return;

	const score =
		parseInt(
			btn.querySelector(".score").textContent.trim().replace(/[()]/g, "")
		) || 0;

	const totalElem = activeCard.querySelector(".total-score");
	const currentTotal = parseInt(totalElem.textContent) || 0;
	totalElem.textContent = currentTotal + score;

	const scoreSpan = btn.querySelector(".score");
	scoreSpan.textContent = score;

	const checkmark = document.createElementNS(
		"http://www.w3.org/2000/svg",
		"svg"
	);
	checkmark.setAttribute("viewBox", "0 0 24 24");
	checkmark.setAttribute("width", "24");
	checkmark.setAttribute("height", "24");
	checkmark.setAttribute("fill", "currentColor");
	checkmark.style.marginRight = "0.25rem";
	const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
	path.setAttribute(
		"d",
		"M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"
	);
	checkmark.appendChild(path);

	scoreSpan.insertBefore(checkmark, scoreSpan.firstChild);

	btn.classList.add("played");

	checkGameOver();
	nextTurn();
}

function checkGameOver() {
	const activeCard = document.querySelector(".card-col.outlined");
	if (!activeCard) return;

	const allButtons = activeCard.querySelectorAll(".game-grid button");
	const playedButtons = activeCard.querySelectorAll(".game-grid button.played");

	if (playedButtons.length === allButtons.length) {
		if (playerCards.length > 1) {
			const allPlayersFinished = Array.from(playerCards).every((card) => {
				const buttons = card.querySelectorAll(".game-grid button");
				const played = card.querySelectorAll(".game-grid button.played");
				return played.length === buttons.length;
			});

			if (allPlayersFinished) {
				showGameOver();
			}
		} else {
			showGameOver();
		}
	}
}

function showGameOver() {
	rollButton.style.display = "none";

	document.querySelectorAll(".card-col.outlined").forEach((card) => {
		card.classList.remove("outlined");
		const badge = card.querySelector(".rounded-bg");
		if (badge) badge.remove();
	});

	const quitButton = document.querySelector("header a.button");
	quitButton.style.backgroundColor = "rgb(252, 176, 23)";
	quitButton.style.color = "white";
	quitButton.style.border = "none";
	quitButton.style.transition = "background-color 0.15s ease";
	quitButton.textContent = "Back to Home";

	quitButton.addEventListener("mouseenter", () => {
		quitButton.style.backgroundColor = "#e69f15";
	});

	quitButton.addEventListener("mouseleave", () => {
		quitButton.style.backgroundColor = "rgb(252, 176, 23)";
	});

	const gameOverDiv = document.createElement("div");
	gameOverDiv.className = "game-over";

	const title = document.createElement("h5");
	title.textContent = "🎉 Game Over!";
	gameOverDiv.appendChild(title);

	if (playerCards.length === 1) {
		const finalScore = document.createElement("p");
		finalScore.className = "final-score-text";
		finalScore.textContent = `Final score: ${parseInt(
			playerCards[0].querySelector(".total-score").textContent
		)} pts`;
		gameOverDiv.appendChild(finalScore);
	} else {
		const resultsLabel = document.createElement("p");
		resultsLabel.className = "results-label";
		resultsLabel.textContent = "Results:";
		gameOverDiv.appendChild(resultsLabel);

		const players = Array.from(playerCards).map((card) => ({
			name: card.querySelector("h3").textContent.trim(),
			score: parseInt(card.querySelector(".total-score").textContent) || 0,
		}));

		players.sort((a, b) => b.score - a.score);

		const rankingsDiv = document.createElement("div");
		rankingsDiv.className = "rankings";

		players.forEach((player, index) => {
			const playerDiv = document.createElement("div");
			playerDiv.className = index === 0 ? "player-rank winner" : "player-rank";

			const nameSpan = document.createElement("span");
			nameSpan.textContent = `${index === 0 ? "👑 " : ""}${player.name}`;

			const scoreSpan = document.createElement("span");
			scoreSpan.textContent = `${player.score} pts`;

			playerDiv.appendChild(nameSpan);
			playerDiv.appendChild(scoreSpan);
			rankingsDiv.appendChild(playerDiv);
		});

		gameOverDiv.appendChild(rankingsDiv);
	}

	document.querySelector(".card-col:has(.dices)").appendChild(gameOverDiv);

	saveGameToDatabase();
}

function saveGameToDatabase() {
	if (playerCards.length === 1) {
		const score =
			parseInt(playerCards[0].querySelector(".total-score").textContent) || 0;

		fetch("?action=save_game", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({
				mode: "solo",
				score: score,
			}),
		});
	} else {
		fetch("?action=save_game", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify({
				mode: "multi",
				players: Array.from(playerCards).map((card) =>
					card.querySelector("h3").textContent.trim()
				),
				scores: Array.from(playerCards).map(
					(card) =>
						parseInt(card.querySelector(".total-score").textContent) || 0
				),
			}),
		});
	}
}

function nextTurn() {
	rollsLeft = 3;
	document.querySelector(".rollsLeft").innerText = rollsLeft;

	const rollButton = document.getElementById("rollButton");
	rollButton.lastChild.textContent = "Roll Dice";
	rollButton.disabled = false;

	dices.querySelectorAll(".dice").forEach(resetDice);

	if (playerCards.length > 1) {
		const activeCard = document.querySelector(".card-col.outlined");

		activeCard
			.querySelectorAll(".game-grid button")
			.forEach((btn) => (btn.disabled = true));

		const playerCardsContainer = document.querySelector(".player-cards");

		activeCard.classList.remove("outlined");
		const badge = activeCard.querySelector(".rounded-bg");
		if (badge) badge.remove();

		playerCardsContainer.appendChild(activeCard);

		const nextCard = playerCardsContainer.querySelector(".card-col");
		nextCard.classList.add("outlined");

		const newBadge = document.createElement("span");
		newBadge.className = "rounded-bg";
		newBadge.textContent = "Your turn";
		nextCard.querySelector(".user-info").appendChild(newBadge);

		const headerText = document.querySelector("header p");
		const playerName = nextCard.querySelector("h3").textContent.trim();
		if (headerText && playerCards.length > 1) {
			headerText.innerHTML = `${playerName}'s turn - <span class="rollsLeft">3</span> rolls left`;
		}
	} else {
		document
			.querySelectorAll(".outlined .game-grid button")
			.forEach((btn) => (btn.disabled = true));
	}
}

function resetDice(dice) {
	dice.classList.remove("selected");
	dice.classList.add("initial");
	dice.dataset.value = "";
	dice.style.backgroundColor = "";
	dice.querySelectorAll(".dot").forEach((dot) => (dot.style.opacity = "0"));
	dice.querySelector(".dot.middle-center").style.opacity = "1";
}

document.addEventListener("DOMContentLoaded", gameStart);
