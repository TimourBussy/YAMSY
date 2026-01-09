function updatePlayerInputs(count) {
	const playerNames = document.getElementById("playerNames");
	const inputs = playerNames.querySelectorAll('input[name="players[]"]');

	const currentCount = inputs.length;

	for (let i = currentCount + 1; i <= count; i++) {
		const input = document.createElement("input");

		input.type = "text";
		input.name = "players[]";
		input.id = `p${i}Name`;
		input.placeholder = `Player ${i}`;

		playerNames.appendChild(input);
	}

	for (let i = currentCount; i > count; i--)
		playerNames.lastElementChild.remove();
}

document.querySelectorAll('input[name="nbPlayers"]').forEach((radio) => {
	radio.addEventListener("change", () => {
		updatePlayerInputs(Number(radio.value));
	});
});

const checkedRadio = document.querySelector('input[name="nbPlayers"]:checked');
if (checkedRadio) updatePlayerInputs(Number(checkedRadio.value));
