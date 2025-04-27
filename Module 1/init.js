const minimizedElementList = document.querySelectorAll(".minimized");
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
const resultE5 = document.querySelector("#result-e5");
const resultE6 = document.querySelector("#result-e6");
const resultM1 = document.querySelector("#result-m1");
const resultM2 = document.querySelector("#result-m2");
const resultM3 = document.querySelector("#result-m3");
const resultM3FirstInput = document.querySelector("#result-m3-first-name");
const resultM3LastInput = document.querySelector("#result-m3-last-name");
const resultM4A = document.querySelector("#result-m4-a");
const resultM4B = document.querySelector("#result-m4-b");
const resultM5 = document.querySelector("#result-m5");
const resultM6 = document.querySelector("#result-m6");
const resultH1A = document.querySelector("#result-h1-a");
const resultH1B = document.querySelector("#result-h1-b");
const resultH2A = document.querySelector("#result-h2-a");
const resultH2B = document.querySelector("#result-h2-b");

minimizedElementList.forEach((element) => {
	element.scrollTop = 0;
});

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", toggleMinimization);
});

[resultM3FirstInput, resultM3LastInput].forEach((button) =>
	button.addEventListener("keydown", (event) => {
		if (event.key === "Enter") updateResults();
	})
);

radius.textContent = radius.dataset.value;
rectangleSide1.textContent = rectangleSide1.dataset.value;
rectangleSide2.textContent = rectangleSide2.dataset.value;
squareSide.textContent = squareSide.dataset.value;
triangleBase.textContent = triangleBase.dataset.value;
triangleHeight.textContent = triangleHeight.dataset.value;

function toggleMinimization(event) {
	const button = event.target;
	const parent = button.parentElement;
	parent.classList.toggle("minimized");
	parent.scrollTop = 0;
}

async function processAssignment(assignment = undefined, info = {}) {
	if (!assignment) return console.warn("processAssignment: No assignment identifier provided.");
	console.info(`Working on assignment ${assignment}...`);

	return fetch("process.php", {
		method: "POST",
		headers: {
			"Content-Type": "application/x-www-form-urlencoded",
		},
		body: new URLSearchParams({
			info: JSON.stringify(info),
			assignment: encodeURIComponent(assignment),
		}),
	})
		.then(async (response) => {
			if (!response.ok) {
				const responseBody = await response.text();
				throw new Error(`Response status: ${response.status}, Response body: ${responseBody}`);
			}
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
	let htmlString = "";

	if (!assignment || typeof assignment !== "string") return console.warn("Invalid or undefined assignment identifier.");
	try {
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
			case "e5":
				data = await processAssignment(assignment, info);
				if (!data || !data.randomNumberResults) return console.warn("No data returned from the server.");

				htmlString = data.randomNumberResults
					.map((result) => `<li><p>${result}</p></li>`)
					.join("");
				resultE5.innerHTML = htmlString;
				break;
			case "e6":
				data = await processAssignment(assignment, info);
				if (!data || !data.sumResults) return console.warn("No data returned from the server.");

				resultE6.textContent = data.sumResults;
				break;
			case "m1":
				data = await processAssignment(assignment, info);
				if (!data || !data.dateTime) return console.warn("No data returned from the server.");

				htmlString = Object.values(data.dateTime)
					.map((result) => `<li><p>${result}</p></li>`)
					.join("");
				resultM1.innerHTML = htmlString;
				break;
			case "m2":
				data = await processAssignment(assignment, info);
				if (!data || !data.currentSeason) return console.warn("No data returned from the server.");

				resultM2.textContent = data.currentSeason;
				break;
			case "m3":
				// Sanitize the input to prevent unexpected behavior
				const firstInput = resultM3FirstInput ? resultM3FirstInput.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";
				const lastInput = resultM3LastInput ? resultM3LastInput.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";

				if (firstInput && lastInput) {
					if ([firstInput, lastInput].some((input) => input.includes(" "))) return console.warn("If both inputs are given, neither should contain spaces.");

					info.inputValue = [firstInput, lastInput];
				} else if (firstInput && !lastInput) {
					if (!firstInput.includes(" ")) return console.warn("If only one input is given, it should contain a space.");

					info.inputValue = firstInput;
				} else if (!firstInput && lastInput) {
					if (!lastInput.includes(" ")) return console.warn("If only one input is given, it should contain a space.");

					info.inputValue = lastInput;
				} else {
					return console.warn("Neither input fields are filled.");
				}

				if (!info.inputValue) return console.warn("There was a non-valid input value given.");

				data = await processAssignment(assignment, info);
				if (!data || !data.returnValue) return console.warn("No data returned from the server.");

				if (Array.isArray(data.returnValue)) {
					resultM3.textContent = `${data.returnValue[0]} ${data.returnValue[1]}`;
				} else {
					resultM3.textContent = data.returnValue;
				}
				break;
			case "m4":
				data = await processAssignment(assignment, info);
				if (!data || !data.statesList) return console.warn("No data returned from the server.");

				resultM4A.textContent = `${data.statesList.length} lidstaten`;
				htmlString = data.statesList
					.map((state) => `<li><p>${state}</p></li>`)
					.join("");
				resultM4B.innerHTML = htmlString;
				break;
			case "m5":
				data = await processAssignment(assignment, info);
				if (!data || !data.multiplesList) return console.warn("No data returned from the server.");

				if (Array.isArray(data.multiplesList) && data.multiplesList.every(Array.isArray)) {
					htmlString = `<colgroup>${
						data.multiplesList
						.map(() => "<col>")
						.join("")
					}</colgroup>`;
					htmlString += `<tbody>${
						data.multiplesList
						.map((multipleRow) => `<tr>${
						multipleRow
							.map((multiple) => `<td>${multiple}</td>`)
							.join("")
							}</tr>`)
						.join("")
					}</tbody>`;
				} else {
					console.warn("Invalid or undefined multiplesList.");
					htmlString = "<p>No valid data available.</p>";
				}
				resultM5.innerHTML = htmlString;
				break;
			case "m6":
				info.magicSentence = "Geef van de meegegeven zin de volgende versies terug";
				info.shuffleWord = "willekeurige";
				info.palindromeWord = "lepel";
				info.anagramWord = ["Torchwood", "Doctor Who"];

				data = await processAssignment(assignment, info);
				if (!data || !data.results) return console.warn("No data returned from the server.");

				htmlString = `<li><p>caseMagic (${info.magicSentence}):</p><ul>${
					Object.values(data.results.caseMagic)
					.map((result) => `<li><p>${result}</p></li>`)
					.join("")
				}</ul></li>`;
				htmlString += `<li><p>shuffleWord (${info.shuffleWord}): ${data.results.shuffleWord}</p></li>`;
				htmlString += `<li><p>isPalindrome (${info.palindromeWord}): ${data.results.isPalindrome}</p></li>`;
				htmlString += `<li><p>isAnagram (${info.anagramWord.join(", ")}): ${data.results.isAnagram}</p></li>`;
				resultM6.innerHTML = htmlString;
				break;
			case "h1":
				data = await processAssignment(assignment, info);
				if (!data || !data.statesList) return console.warn("No data returned from the server.");

				resultH1A.textContent = `${data.statesList.length} lidstaten`;
				htmlString = data.statesList
					.map((state) => `<li><p>${state}</p></li>`)
					.join("");
				resultH1B.innerHTML = htmlString;
				break;
			case "h2":
				info.letter = "b";

				data = await processAssignment(assignment, info);
				if (!data || !data.statesList) return console.warn("No data returned from the server.");
				
				resultH2A.textContent = `${data.statesList.length} lidstaten`;
				htmlString = data.statesList
					.map((state) => `<li><p>${state}</p></li>`)
					.join("");
				resultH2B.innerHTML = htmlString;
				break;
			default:
				console.warn(`We haven't implemented the assignment ${assignment} yet.`);
				break;
		}
	} catch (error) {
		return console.error("Error processing assignment:", error);
	}
}

updateResults();
