const submitBtn = document.getElementById("submitBtn");
const originalText = submitBtn.textContent;

document.getElementById("authForm").addEventListener("submit", function (e) {
	submitBtn.disabled = true;
	submitBtn.textContent = "Loading...";
});

window.addEventListener("pageshow", function (event) {
	if (event.persisted) {
		submitBtn.disabled = false;
		submitBtn.textContent = originalText;
	}
});
