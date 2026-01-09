const loginBtn = document.getElementById("loginBtn");
const originalText = loginBtn.textContent;

document.getElementById("authForm").addEventListener("submit", function (e) {
	loginBtn.disabled = true;
	loginBtn.textContent = "Loading...";
});

window.addEventListener("pageshow", function (event) {
	if (event.persisted) {
		loginBtn.disabled = false;
		loginBtn.textContent = originalText;
	}
});
