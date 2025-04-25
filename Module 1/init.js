const minimizeButtonList = document.querySelectorAll(".minimize");
const assignment = document.querySelector("#assignment").value;
const radius = document.querySelector("#radius");
const rectangleSide1 = document.querySelector("#rectangleSide1");
const rectangleSide2 = document.querySelector("#rectangleSide2");
const squareSide = document.querySelector("#squareSide");
const triangleBase = document.querySelector("#triangleBase");
const triangleHeight = document.querySelector("#triangleHeight");
const resultE1 = document.querySelector("#result-e1");
const resultE2A = document.querySelector("#result-e2-a");
const resultE2B = document.querySelector("#result-e2-b");
const resultE2C = document.querySelector("#result-e2-c");
const resultE3 = document.querySelector("#result-e3");
const resultE4 = document.querySelector("#result-e4");

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", minimizeSection);
});

radius.textContent = radius.dataset.value;
rectangleSide1.textContent = rectangleSide1.dataset.value;
rectangleSide2.textContent = rectangleSide2.dataset.value;
squareSide.textContent = squareSide.dataset.value;
triangleBase.textContent = triangleBase.dataset.value;
triangleHeight.textContent = triangleHeight.dataset.value;

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
			info.radius = parseFloat(Number(radius.dataset.value));
			if (isNaN(info.radius)) return console.warn("There was a non-valid radius given.");

			data = await processAssignment(assignment, info);
			resultE1.textContent = data && data.surfaceAreaCirkel ? data.surfaceAreaCirkel : "N/A";
			break;
		case "e2":
			info.rectangleSide1 = parseFloat(Number(rectangleSide1.dataset.value));
			info.rectangleSide2 = parseFloat(Number(rectangleSide2.dataset.value));
			info.squareSide = parseFloat(Number(squareSide.dataset.value));
			info.triangleBase = parseFloat(Number(triangleBase.dataset.value));
			info.triangleHeight = parseFloat(Number(triangleHeight.dataset.value));
			if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

			data = await processAssignment(assignment, info);
			resultE2A.textContent = data && data.surfaceAreaRectangle ? `${data.surfaceAreaRectangle}cm²` : "N/A";
			resultE2B.textContent = data && data.surfaceAreaSquare ? `${data.surfaceAreaSquare}cm²` : "N/A";
			resultE2C.textContent = data && data.surfaceAreaTriangle ? `${data.surfaceAreaTriangle}cm²` : "N/A";
			break;
		case "e3":
			info.rectangleSide1 = parseFloat(Number(rectangleSide1.dataset.value));
			info.rectangleSide2 = parseFloat(Number(rectangleSide2.dataset.value));
			info.squareSide = parseFloat(Number(squareSide.dataset.value));
			info.triangleBase = parseFloat(Number(triangleBase.dataset.value));
			info.triangleHeight = parseFloat(Number(triangleHeight.dataset.value));
			if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

			data = await processAssignment(assignment, info);
			resultE3.textContent = data && !isNaN(data.functionsExecutedCounter) ? data.functionsExecutedCounter : "N/A";
			break;
		case "e4":
			data = await processAssignment(assignment, info);
			if (!data || !data.variabelTest) return console.warn("No data returned from the server.");

			resultE4.innerHTML = `
			<li><p>Variabele 1: ${data.variabelTest.variabel1}</p></li>
			<li><p>Variabele 2: ${data.variabelTest.variabel2}</p></li>
			<li><p>Variabele 3: ${data.variabelTest.variabel3}</p></li>
			<li><p>Variabele 4: ${data.variabelTest.variabel4}</p></li>
			<li><p>Variabele 5: ${data.variabelTest.variabel5[0]}, ${data.variabelTest.variabel5[1]}</p></li>`;
			break;
		default:
			break;
	}
}

updateResults();
