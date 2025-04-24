const minimizeButtonList = document.querySelectorAll(".minimize");
const straal = document.querySelector("#straal");
const result = document.querySelector("#result");

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", () => minimizeSection(event));
});

straal.textContent = straal.dataset.value;

function minimizeSection(event) {
	const button = event.target;
	const section = button.parentElement;
	section.classList.toggle("minimized");
}

async function updateResults() {
	await fetch("Easy/process.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		},
		body: new URLSearchParams({
			straal: straal.dataset.value,
		}),
	})
		.then((response) => {
			if (!response.ok) throw new Error(`Response status: ${response.status}`);
			return response.json();
		})
		.then((response) => {
			result.textContent = response.result;
		})
		.catch((error) => {
			console.error("Error:", error.message);
		});
}

updateResults();
