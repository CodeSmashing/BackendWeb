const minimizedElementList = document.querySelectorAll(".minimized");
const minimizeButtonList = document.querySelectorAll(".minimize");
const asideElement = document.querySelector("aside");
const maxWidth = document.documentElement.clientWidth;
const mouseXThresholdLarge = maxWidth * 0.25;
const mouseXThresholdSmall = maxWidth * 0.1;
const inputRadius = document.querySelector("#input-e1-radius");
const inputRecSideA = document.querySelector("#input-e2-recSideA");
const inputRecSideB = document.querySelector("#input-e2-recSideB");
const inputSquareSide = document.querySelector("#input-e2-squareSide");
const inputTriangleBase = document.querySelector("#input-e2-triangleBase");
const inputTriangleHeight = document.querySelector("#input-e2-triangleHeight");
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
const inputFirstName = document.querySelector("#input-m3-first-name");
const inputLastName = document.querySelector("#input-m3-last-name");
const resultM4A = document.querySelector("#result-m4-a");
const resultM4B = document.querySelector("#result-m4-b");
const resultM5 = document.querySelector("#result-m5");
const resultM6 = document.querySelector("#result-m6");
const resultH1A = document.querySelector("#result-h1-a");
const resultH1B = document.querySelector("#result-h1-b");
const resultH2A = document.querySelector("#result-h2-a");
const resultH2B = document.querySelector("#result-h2-b");
const resultH3A = document.querySelector("#result-h3-a");
const resultH3B = document.querySelector("#result-h3-b");
const resultC1 = document.querySelector("#result-c1");
const inputTextToConvert = document.querySelector("#input-c1-textToConvert");
const resultC2A = document.querySelector("#result-c2-a");
const resultC2B = document.querySelector("#result-c2-b");
const resultC3A = document.querySelector("#result-c3-a");
const resultC3B = document.querySelector("#result-c3-b");
let assignment = document.querySelector("#assignment").value;

minimizedElementList.forEach((element) => {
	element.scrollTop = 0;
});

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", toggleMinimization);
});

[inputFirstName, inputLastName].forEach((button) =>
	button.addEventListener("keydown", (event) => {
		if (event.key === "Enter") updateResults();
	})
);

document.addEventListener("mousemove", handleAsideVisibility);
asideElement.addEventListener("click", handleAsideClick);

inputRadius.textContent = inputRadius.dataset.value;
inputRecSideA.textContent = inputRecSideA.dataset.value;
inputRecSideB.textContent = inputRecSideB.dataset.value;
inputSquareSide.textContent = inputSquareSide.dataset.value;
inputTriangleBase.textContent = inputTriangleBase.dataset.value;
inputTriangleHeight.textContent = inputTriangleHeight.dataset.value;
inputTextToConvert.textContent = '\"' + inputTextToConvert.dataset.value + '\"';
resultC2A.textContent = resultC2A.dataset.value;

function handleAsideVisibility(event) {
	const mouseX = event.clientX;
    const classList = asideElement.classList;

	const showAside = () => {
		classList.add("show");
		classList.remove("hidden", "hidden-transition");
	};

	const hideAside = () => {
		classList.add("hidden");
		classList.remove("show", "hidden-transition");
	};

	const transitionAside = () => {
		classList.add("hidden-transition");
		classList.remove("show", "hidden");
	};

	// Cursor is hovering over the aside
	if (mouseX <= asideElement.clientWidth) {
		showAside();
		return;
	}

	// Cursor is hovering over the large target
	if (mouseX <= mouseXThresholdLarge && mouseX > mouseXThresholdSmall) {
		transitionAside();
		return;
	}

	// Cursor is hovering over the small target
	if (mouseX <= mouseXThresholdSmall) {
		showAside();
		return;
	}

	// Cursor isn't hovering over any target
	hideAside();
}

function handleAsideClick(event) {
	const anchor = event.target.closest("a");
	if (!anchor) return;

	const sectionId = anchor.hash ? anchor.hash.slice(1) : null;
	if (!sectionId) return;

	const section = document.querySelector(`#${sectionId}`);
    if (!section) return;

	const article = section.parentElement;
    if (!article) return;

	const articleList = Array.from(document.querySelectorAll(`& > article:not([id=${article.id}])`));
	const sectionList = Array.from(article.querySelectorAll(`& > section:not([id=${sectionId}])`));

	updateAssignment(sectionId);
	maximize([article, section]);
	minimize(articleList);
	minimize(sectionList);
}

function minimize(list) {
	list.forEach((item) => {
		if (!item.classList.contains("minimized")) item.classList.add("minimized");
		item.scrollTop = 0;
	});
}

function maximize(list) {
	list.forEach((item) => {
		item.classList.remove("minimized");
		item.scrollTop = 0;
	});
}

function toggleMinimization(event) {
	const button = event.target;
	const parent = button.parentElement;
	parent.classList.toggle("minimized");
	parent.scrollTop = 0;

	if (parent.tagName === "SECTION" && !parent.classList.contains("minimized")) {
		updateAssignment(parent.id);
	}
}

function updateAssignment(id) {
	assignment = id.substring(id.indexOf("-") + 1);
	updateResults();
}

async function processAssignment(assignment = undefined, info = {}) {
	if (!assignment) return console.warn("processAssignment: No assignment identifier provided.");
	console.info(`Working on assignment ${assignment}...`);

	// return fetch("process.php", {
	// 	method: "POST",
	// 	headers: {
	// 		"Content-Type": "application/x-www-form-urlencoded",
	// 	},
	// 	body: new URLSearchParams({
	// 		info: JSON.stringify(info),
	// 		assignment: encodeURIComponent(assignment),
	// 	}),
	// })
	// 	.then(async (response) => {
	// 		if (!response.ok) {
	// 			const responseBody = await response.text();
	// 			throw new Error(`Response status: ${response.status}, Response body: ${responseBody}`);
	// 		}
	// 		return response.json();
	// 	})
	// 	.then((response) => {
	// 		console.log("The response:", response);
	// 		return response;
	// 	})
	// 	.catch((error) => {
	// 		console.error("Error occurred:", error);
	// 	});
}

async function updateResults() {
	let info = {};
	let data = {};
	let htmlString = "";

	if (!assignment || typeof assignment !== "string") return console.warn("Invalid or undefined assignment identifier.");
	try {
		switch (assignment) {
			case "e1":
				info.radius = parseFloat(Number(inputRadius.dataset.value));
				if (isNaN(info.radius)) return console.warn("There was a non-valid radius given.");

				data = await processAssignment(assignment, info);
				// resultE1.textContent = data && data.surfaceAreaCirkel ? data.surfaceAreaCirkel : "N/A";
				break;
			case "e2":
				info.recSideA = parseFloat(Number(inputRecSideA.dataset.value));
				info.recSideB = parseFloat(Number(inputRecSideB.dataset.value));
				info.squareSide = parseFloat(Number(inputSquareSide.dataset.value));
				info.triangleBase = parseFloat(Number(inputTriangleBase.dataset.value));
				info.triangleHeight = parseFloat(Number(inputTriangleHeight.dataset.value));
				if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

				data = await processAssignment(assignment, info);
				// resultE2A.textContent = data && data.surfaceAreaRectangle ? `${data.surfaceAreaRectangle}cm²` : "N/A";
				// resultE2B.textContent = data && data.surfaceAreaSquare ? `${data.surfaceAreaSquare}cm²` : "N/A";
				// resultE2C.textContent = data && data.surfaceAreaTriangle ? `${data.surfaceAreaTriangle}cm²` : "N/A";
				break;
			case "e3":
				info.recSideA = parseFloat(Number(inputRecSideA.dataset.value));
				info.recSideB = parseFloat(Number(inputRecSideB.dataset.value));
				info.squareSide = parseFloat(Number(inputSquareSide.dataset.value));
				info.triangleBase = parseFloat(Number(inputTriangleBase.dataset.value));
				info.triangleHeight = parseFloat(Number(inputTriangleHeight.dataset.value));
				if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

				data = await processAssignment(assignment, info);
				// resultE3.textContent = data && !isNaN(data.functionsExecutedCounter) ? data.functionsExecutedCounter : "N/A";
				break;
			case "e4":
				data = await processAssignment(assignment, info);
				// if (!data || !data.variabelTest) return console.warn("No data returned from the server.");

				// resultE4.innerHTML = `
				// <li><p>Variabele 1: ${data.variabelTest.variabel1}</p></li>
				// <li><p>Variabele 2: ${data.variabelTest.variabel2}</p></li>
				// <li><p>Variabele 3: ${data.variabelTest.variabel3}</p></li>
				// <li><p>Variabele 4: ${data.variabelTest.variabel4}</p></li>
				// <li><p>Variabele 5: ${data.variabelTest.variabel5[0]}, ${data.variabelTest.variabel5[1]}</p></li>`;
				break;
			case "e5":
				data = await processAssignment(assignment, info);
				// if (!data || !data.randomNumberResults) return console.warn("No data returned from the server.");

				// htmlString = data.randomNumberResults
				// 	.map((result) => `<li><p>${result}</p></li>`)
				// 	.join("");
				// resultE5.innerHTML = htmlString;
				break;
			case "e6":
				data = await processAssignment(assignment, info);
				// if (!data || !data.sumResults) return console.warn("No data returned from the server.");

				// resultE6.textContent = data.sumResults;
				break;
			case "m1":
				data = await processAssignment(assignment, info);
				// if (!data || !data.dateTime) return console.warn("No data returned from the server.");

				// htmlString = Object.values(data.dateTime)
				// 	.map((result) => `<li><p>${result}</p></li>`)
				// 	.join("");
				// resultM1.innerHTML = htmlString;
				break;
			case "m2":
				data = await processAssignment(assignment, info);
				// if (!data || !data.currentSeason) return console.warn("No data returned from the server.");

				// resultM2.textContent = data.currentSeason;
				break;
			case "m3":
				// Sanitize the input to prevent unexpected behavior
				const firstInput = inputFirstName ? inputFirstName.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";
				const lastInput = inputLastName ? inputLastName.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";

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
				// if (!data || !data.returnValue) return console.warn("No data returned from the server.");

				// if (Array.isArray(data.returnValue)) {
				// 	resultM3.textContent = `${data.returnValue[0]} ${data.returnValue[1]}`;
				// } else {
				// 	resultM3.textContent = data.returnValue;
				// }
				break;
			case "m4":
				data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultM4A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultM4B.innerHTML = htmlString;
				break;
			case "m5":
				data = await processAssignment(assignment, info);
				// if (!data || !data.multiplesList) return console.warn("No data returned from the server.");

				// if (Array.isArray(data.multiplesList) && data.multiplesList.every(Array.isArray)) {
				// 	htmlString = `<colgroup>${
				// 		data.multiplesList
				// 		.map(() => "<col>")
				// 		.join("")
				// 	}</colgroup>`;
				// 	htmlString += `<tbody>${
				// 		data.multiplesList
				// 		.map((multipleRow) => `<tr>${
				// 		multipleRow
				// 			.map((multiple) => `<td>${multiple}</td>`)
				// 			.join("")
				// 			}</tr>`)
				// 		.join("")
				// 	}</tbody>`;
				// } else {
				// 	console.warn("Invalid or undefined multiplesList.");
				// 	htmlString = "<p>No valid data available.</p>";
				// }
				// resultM5.innerHTML = htmlString;
				break;
			case "m6":
				info.magicSentence = "Geef van de meegegeven zin de volgende versies terug";
				info.shuffleWord = "willekeurige";
				info.palindromeWord = "lepel";
				info.anagramWord = ["Torchwood", "Doctor Who"];

				data = await processAssignment(assignment, info);
				// if (!data || !data.results) return console.warn("No data returned from the server.");

				// htmlString = `<li><p>caseMagic (${info.magicSentence}):</p><ul>${
				// 	Object.values(data.results.caseMagic)
				// 	.map((result) => `<li><p>${result}</p></li>`)
				// 	.join("")
				// }</ul></li>`;
				// htmlString += `<li><p>shuffleWord (${info.shuffleWord}): ${data.results.shuffleWord}</p></li>`;
				// htmlString += `<li><p>isPalindrome (${info.palindromeWord}): ${data.results.isPalindrome}</p></li>`;
				// htmlString += `<li><p>isAnagram (${info.anagramWord.join(", ")}): ${data.results.isAnagram}</p></li>`;
				// resultM6.innerHTML = htmlString;
				break;
			case "h1":
				data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH1A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH1B.innerHTML = htmlString;
				break;
			case "h2":
				info.letter = "b";

				data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH2A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH2B.innerHTML = htmlString;
				break;
			case "h3":
				info.letter = "b";

				data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH3A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH3B.innerHTML = htmlString;
				break;
			case "c1":
				info.inputString = inputTextToConvert.dataset.value;

				data = await processAssignment(assignment, info);
				// if (!data || !data.textToNumber) return console.warn("No data returned from the server.");

				// resultC1.textContent = data.textToNumber;
				break;
			case "c2":
				info.limit = resultC2A.dataset.value;

				data = await processAssignment(assignment, info);
				// if (!data || !data.fibonacciSequence) return console.warn("No data returned from the server.");

				// resultC2B.textContent = data.fibonacciSequence.join(", ");
				break;
			case "c3":
				info.number = resultC3A.dataset.value;

				data = await processAssignment(assignment, info);
				// if (!data || !data.multipleOfTwo) return console.warn("No data returned from the server.");

				// resultC3A.textContent = `${resultC3A.dataset.value} is ${data.multipleOfTwo.isMultiple ? "een" : "geen"}`;
				// resultC3B.textContent = `${data.multipleOfTwo.isMultiple ? `2^${data.multipleOfTwo.power}` : `het dichtste veelvoud is ${2 ** data.multipleOfTwo.power}, 2^${data.multipleOfTwo.power}`}`;
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
