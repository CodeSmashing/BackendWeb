const minimizedElementList = document.querySelectorAll(".minimized");
const minimizeButtonList = document.querySelectorAll(".minimize");
const formList = document.querySelectorAll("form");
const asideElement = document.querySelector("aside");
const maxWidth = document.documentElement.clientWidth;
const mouseXThresholdLarge = 200;
const mouseXThresholdSmall = 20;
let assignment = document.querySelector("#assignment").value;

minimizedElementList.forEach((element) => {
	element.scrollTop = 0;
});

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", toggleMinimization);
});

formList.forEach((form) => {
	form.addEventListener("submit", submitForm);
});

// Should probably debounce "mousemove"
document.addEventListener("mousemove", handleAsideVisibility);
asideElement.addEventListener("click", handleAsideClick);
asideElement.dispatchEvent(new Event("click", { bubbles: true, cancelable: false }));

function showAside(classList) {
	if (!classList) return console.warn("showAside: No classList provided");
	classList.add("show");
	classList.remove("hidden", "hidden-transition");
}

function hideAside(classList) {
	if (!classList) return console.warn("hideAside: No classList provided");
	classList.add("hidden");
	classList.remove("show", "hidden-transition");
}

function transitionAside(classList) {
	if (!classList) return console.warn("transitionAside: No classList provided");
	classList.add("hidden-transition");
	classList.remove("show", "hidden");
}

function handleAsideVisibility(event) {
	const mouseX = event.clientX;
    const classList = asideElement.classList;

	// Cursor is hovering over the aside
	if (mouseX <= asideElement.clientWidth) {
		showAside(classList);
		return;
	}

	// Cursor is hovering over the large target
	if (mouseX <= mouseXThresholdLarge && mouseX > mouseXThresholdSmall) {
		transitionAside(classList);
		return;
	}

	// Cursor is hovering over the small target
	if (mouseX <= mouseXThresholdSmall) {
		showAside(classList);
		return;
	}

	// Cursor isn't hovering over any target
	hideAside(classList);
}

function handleAsideClick(event) {
	const anchor = event.target !== asideElement ?
		event.target.closest("a") :
		asideElement.querySelector(`a[href$="-${assignment}"]`);
	if (!anchor) return;

	const assignmentId = anchor.hash ? anchor.hash.slice(1) : null;
	if (!assignmentId) return;

	const assignmentContainer = document.querySelector(`#${assignmentId}`);
    if (!assignmentContainer) return;

	const moduleContainer = assignmentContainer.parentElement;
    if (!moduleContainer) return;

	const moduleContainerList = Array.from(document.querySelectorAll(`& > article:not([id=${moduleContainer.id}])`));
	const assignmentContainerList = Array.from(moduleContainer.querySelectorAll(`& > section:not([id=${assignmentId}])`));

	assignment = assignmentId;
	maximize([moduleContainer, assignmentContainer]);
	minimize(moduleContainerList);
	minimize(assignmentContainerList);
	assignmentContainer.scrollIntoView();
	updateResults(assignmentContainer);
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
		assignment = parent.id;
		updateResults(parent);
	}
}

function validateForm(form) {
	const replacementTarget = assignment.replace("assignment", "input");
	const inputList = Array.from(form.querySelectorAll("input"));
	const inputObjectList = {};
	const regExpList = {
		username: /^(?=.*[\w.])[\w.]{4,25}$/,
		password: /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$/,
		country: /^[A-Za-zÀ-ÿ\s\-']{2,40}$/
	};

	for (const input of inputList) {
		const field = input.id.replace(`${replacementTarget}-`, "");
		const value = input.value.trim() || null;
		const isRequired = input.required;
		const hasRegExp = regExpList[field] ? true : false;
		let passedRegExp = null;

		if (hasRegExp && value !== null) {
			passedRegExp = regExpList[field].test(value);
		} else if (hasRegExp && value === null) {
			passedRegExp = false;
		} else {
			passedRegExp = true;
		}

		inputObjectList[field] = { isRequired, passedRegExp, value, input };
	}

	return inputObjectList;
}

function submitForm(event) {
	event.preventDefault();
	const form = event.target;
	const action = event.submitter.dataset.action;
	const actionMessages = {
		"sign-in": "Requesting sign in...",
		"sign-up": "Requesting sign up...",
		"password-reset": "Requesting password reset...",
		"data-submission": "Requesting data submission...",
	};
	assignment = form.id.replace("form", "assignment");

	const validationResultList = validateForm(form);
	const validResultList = {};

	for (const [key, { isRequired, passedRegExp, selector, value }] of Object.entries(validationResultList)) {
		if (isRequired) {
			if (value === null) {
				selector.classList.add("error");
				return console.warn(`The ${key} input is required.`);
			}

			if (passedRegExp === false) {
				selector.classList.add("error");
				return console.warn(`The ${key} input did not meet the input requirements.`);
			}
		}

		validResultList[key] = value;
	}

	updateResults(form.parentElement, form, { message: actionMessages[action], action, validResultList });
	form.reset();
}

async function sendRequest(assignment = undefined, info = {}) {
	if (!assignment) return console.warn("sendRequest: No assignment identifier provided.");
	console.info(`Working on assignment ${assignment}...`);

	if (info.message) console.info(info.message);

	return fetch("/api/process", {
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
			console.info(`The response: ${response.exitCode.name} => ${response.exitCode.message}`);
			return response;
		})
		.catch((error) => {
			console.error("Error occurred:", error);
		});
}

async function updateResults(section, form = undefined, info = {}) {
	let data = {};
	let htmlString = "";

	if (!assignment || typeof assignment !== "string") return console.warn("Invalid or undefined assignment identifier.");
	if (!section || typeof section !== "object") return console.warn("Invalid or undefined section provided.");
	try {
		switch (assignment) {
			case "m1-assignment-e1":
				info.radius = parseFloat(Number(section.querySelector("#m1-input-e1-radius").dataset.value));
				if (isNaN(info.radius)) return console.warn("There was a non-valid radius given.");

				data = await sendRequest(assignment, info);
				section.querySelector("#m1-output-e1-surfaceArea").textContent = data && data.additionalData.surfaceAreaCirkel ? data.additionalData.surfaceAreaCirkel : "N/A";
				break;
			case "m1-assignment-e2":
				info.recSideA = parseFloat(Number(section.querySelector("#m1-input-e2-recSideA").dataset.value));
				info.recSideB = parseFloat(Number(section.querySelector("#m1-input-e2-recSideB").dataset.value));
				info.squareSide = parseFloat(Number(section.querySelector("#m1-input-e2-squareSide").dataset.value));
				info.triangleBase = parseFloat(Number(section.querySelector("#m1-input-e2-triangleBase").dataset.value));
				info.triangleHeight = parseFloat(Number(section.querySelector("#m1-input-e2-triangleHeight").dataset.value));
				if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

				data = await sendRequest(assignment, info);
				section.querySelector("#m1-output-e2-rectangle").textContent = data && data.additionalData.surfaceAreaRectangle ? `${data.additionalData.surfaceAreaRectangle}cm²` : "N/A";
				section.querySelector("#m1-output-e2-square").textContent = data && data.additionalData.surfaceAreaSquare ? `${data.additionalData.surfaceAreaSquare}cm²` : "N/A";
				section.querySelector("#m1-output-e2-triangle").textContent = data && data.additionalData.surfaceAreaTriangle ? `${data.additionalData.surfaceAreaTriangle}cm²` : "N/A";
				break;
			case "m1-assignment-e3":
				// info.recSideA = parseFloat(Number(inputRecSideA.dataset.value));
				// info.recSideB = parseFloat(Number(inputRecSideB.dataset.value));
				// info.squareSide = parseFloat(Number(inputSquareSide.dataset.value));
				// info.triangleBase = parseFloat(Number(inputTriangleBase.dataset.value));
				// info.triangleHeight = parseFloat(Number(inputTriangleHeight.dataset.value));
				// if (Object.values(info).some((value) => isNaN(value))) return console.warn("There was a non-valid side given.");

				// data = await processAssignment(assignment, info);
				// resultE3.textContent = data && !isNaN(data.functionsExecutedCounter) ? data.functionsExecutedCounter : "N/A";
				break;
			case "m1-assignment-e4":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.variabelTest) return console.warn("No data returned from the server.");

				// resultE4.innerHTML = `
				// <li><p>Variabele 1: ${data.variabelTest.variabel1}</p></li>
				// <li><p>Variabele 2: ${data.variabelTest.variabel2}</p></li>
				// <li><p>Variabele 3: ${data.variabelTest.variabel3}</p></li>
				// <li><p>Variabele 4: ${data.variabelTest.variabel4}</p></li>
				// <li><p>Variabele 5: ${data.variabelTest.variabel5[0]}, ${data.variabelTest.variabel5[1]}</p></li>`;
				break;
			case "m1-assignment-e5":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.randomNumberResults) return console.warn("No data returned from the server.");

				// htmlString = data.randomNumberResults
				// 	.map((result) => `<li><p>${result}</p></li>`)
				// 	.join("");
				// resultE5.innerHTML = htmlString;
				break;
			case "m1-assignment-e6":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.sumResults) return console.warn("No data returned from the server.");

				// resultE6.textContent = data.sumResults;
				break;
			case "m1-assignment-m1":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.dateTime) return console.warn("No data returned from the server.");

				// htmlString = Object.values(data.dateTime)
				// 	.map((result) => `<li><p>${result}</p></li>`)
				// 	.join("");
				// resultM1.innerHTML = htmlString;
				break;
			case "m1-assignment-m2":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.currentSeason) return console.warn("No data returned from the server.");

				// resultM2.textContent = data.currentSeason;
				break;
			case "m1-assignment-m3":
				// // Sanitize the input to prevent unexpected behavior
				// const firstInput = inputFirstName ? inputFirstName.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";
				// const lastInput = inputLastName ? inputLastName.value.replace(/[^a-zA-Z0-9 ]/g, "").trim() : "";

				// if (firstInput && lastInput) {
				// 	if ([firstInput, lastInput].some((input) => input.includes(" "))) return console.warn("If both inputs are given, neither should contain spaces.");

				// 	info.inputValue = [firstInput, lastInput];
				// } else if (firstInput && !lastInput) {
				// 	if (!firstInput.includes(" ")) return console.warn("If only one input is given, it should contain a space.");

				// 	info.inputValue = firstInput;
				// } else if (!firstInput && lastInput) {
				// 	if (!lastInput.includes(" ")) return console.warn("If only one input is given, it should contain a space.");

				// 	info.inputValue = lastInput;
				// } else {
				// 	return console.warn("Neither input fields are filled.");
				// }

				// if (!info.inputValue) return console.warn("There was a non-valid input value given.");

				// data = await processAssignment(assignment, info);
				// if (!data || !data.returnValue) return console.warn("No data returned from the server.");

				// if (Array.isArray(data.returnValue)) {
				// 	resultM3.textContent = `${data.returnValue[0]} ${data.returnValue[1]}`;
				// } else {
				// 	resultM3.textContent = data.returnValue;
				// }
				break;
			case "m1-assignment-m4":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultM4A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultM4B.innerHTML = htmlString;
				break;
			case "m1-assignment-m5":
				// data = await processAssignment(assignment, info);
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
			case "m1-assignment-m6":
				// info.magicSentence = "Geef van de meegegeven zin de volgende versies terug";
				// info.shuffleWord = "willekeurige";
				// info.palindromeWord = "lepel";
				// info.anagramWord = ["Torchwood", "Doctor Who"];

				// data = await processAssignment(assignment, info);
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
			case "m1-assignment-h1":
				// data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH1A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH1B.innerHTML = htmlString;
				break;
			case "m1-assignment-h2":
				// info.letter = "b";

				// data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH2A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH2B.innerHTML = htmlString;
				break;
			case "m1-assignment-h3":
				// info.letter = "b";

				// data = await processAssignment(assignment, info);
				// if (!data || !data.statesList) return console.warn("No data returned from the server.");

				// resultH3A.textContent = `${data.statesList.length} lidstaten`;
				// htmlString = data.statesList
				// 	.map((state) => `<li><p>${state}</p></li>`)
				// 	.join("");
				// resultH3B.innerHTML = htmlString;
				break;
			case "m1-assignment-c1":
				// info.inputString = inputTextToConvert.dataset.value;

				// data = await processAssignment(assignment, info);
				// if (!data || !data.textToNumber) return console.warn("No data returned from the server.");

				// resultC1.textContent = data.textToNumber;
				break;
			case "m1-assignment-c2":
				// info.limit = inputC2.dataset.value;

				// data = await processAssignment(assignment, info);
				// if (!data || !data.fibonacciSequence) return console.warn("No data returned from the server.");

				// resultC2.textContent = data.fibonacciSequence.join(", ");
				break;
			case "m1-assignment-c3":
				// info.number = inputC3.dataset.value;

				// data = await processAssignment(assignment, info);
				// if (!data || !data.multipleOfTwo) return console.warn("No data returned from the server.");

				// inputC3.textContent = `${inputC3.dataset.value} is ${data.multipleOfTwo.isMultiple ? "een" : "geen"}`;
				// resultC3.textContent = `${data.multipleOfTwo.isMultiple ? `2^${data.multipleOfTwo.power}` : `het dichtste veelvoud is ${2 ** data.multipleOfTwo.power}, 2^${data.multipleOfTwo.power}`}`;
				break;
			case "m2-assignment-e1":
			case "m2-assignment-e2":
				if (!form || typeof form !== "object") return console.warn("Invalid or undefined form provided.");

				data = await sendRequest(assignment, info);
				if (!data) return console.warn("No data returned from the server.");

				for (const errorCode in data.errors) {
					if (data.errors[errorCode].length > 0) {
						for (const errorCase of data.errors[errorCode]) {
							const replacementTarget = assignment.replace("assignment", "input");
							const field = errorCase.slice(errorCase.lastIndexOf("-") + 1);
							const input = form.querySelector(`#${replacementTarget}-${field}`);
							if (input) input.classList.add("error");
						}
					}
				}

				for (const field in data.additionalData) {
					const replacementTarget = assignment.replace("assignment", "output");
					const output = section.querySelector(`#${replacementTarget}-${field}`);
					if (output) {
						output.textContent = data.additionalData[field] ? data.additionalData[field] : "...";
					}
				}
				break;
			case "m2-assignment-e3":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-e4":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-m1":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-m2":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-m3":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-h1":
				// data = await sendRequest(assignment, info);
				break;
			case "m2-assignment-c1":
				// data = await sendRequest(assignment, info);
				break;
			default:
				console.warn(`We haven't implemented the assignment ${assignment} yet.`);
				break;
		}
	} catch (error) {
		return console.error("Error processing assignment:", error);
	}
}
