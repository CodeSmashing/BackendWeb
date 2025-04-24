const minimizeButtonList = document.querySelectorAll(".minimize");
const radius = document.querySelector("#radius");
const resultE1 = document.querySelector("#result-e1");
const assignment = document.querySelector("#assignment").value;

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", minimizeSection);
});

radius.textContent = radius.dataset.value;

function minimizeSection(event) {
	const button = event.target;
	const section = button.parentElement;
	section.classList.toggle("minimized");
}

async function processAssignment(assignment = undefined, info = {}) {
	if (!assignment) return console.warn("No assignment identifier provided to processAssignment.");
	console.info(`Working on assignment ${assignment}...`);

	return fetch("process.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		},
		body: new URLSearchParams({
			info: JSON.stringify(info),
			assignment,
		}),
	})
		.then((response) => {
			if (!response.ok) throw new Error(`Response status: ${response.status}, Response body: ${response.text}`);
			return response.json();
		})
		.then((response) => {
			console.log("The response:", response);
			return response;
		})
		.catch((error) => {
			console.error("Error occurred:", error);
		});
}

async function updateResults() {
	let info = {};
	let data = {};

	switch (assignment) {
		case "e1":
			const radiusValue = parseFloat(radius.dataset.value);
			if (isNaN(radiusValue)) return console.warn("No valid radius was given.");

			info.radius = radiusValue;
			data = await processAssignment(assignment, info);
			resultE1.textContent = data && data.surfaceArea ? data.surfaceArea : "N/A";
			break;
		default:
			break;
	}
}

updateResults();
