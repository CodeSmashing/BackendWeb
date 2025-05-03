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

	const sectionId = anchor.hash ? anchor.hash.slice(1) : null;
	if (!sectionId) return;

	const section = document.querySelector(`#${sectionId}`);
    if (!section) return;

	const article = section.parentElement;
    if (!article) return;

	const articleList = Array.from(document.querySelectorAll(`& > article:not([id=${article.id}])`));
	const sectionList = Array.from(article.querySelectorAll(`& > section:not([id=${sectionId}])`));

	updateAssignment(section);
	maximize([article, section]);
	minimize(articleList);
	minimize(sectionList);
	section.scrollIntoView();
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
		updateAssignment(parent);
	}
}

function updateAssignment(element) {
	assignment = element.id.match(/^.*-([emhc][0-9]{1,})(-)?.*$/)[1];
}

function validateForm(form) {
	const inputList = Array.from(form.querySelectorAll("input"));
	const inputObjectList = {};
	const regExpList = {
		username: /^(?=.*[\w.])[\w.]{4,25}$/,
		password: /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$/,
		country: /^[A-Za-zÀ-ÿ\s\-']{2,40}$/
	};

	for (const input of inputList) {
		const field = input.id.replace(`input-${assignment}-`, "");
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
	updateAssignment(form);

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
			case "e1":
			case "e2":
				if (!form || typeof form !== "object") return console.warn("Invalid or undefined form provided.");

				data = await sendRequest(assignment, info);
				if (!data) return console.warn("No data returned from the server.");

				for (const errorCode in data.errors) {
					if (data.errors[errorCode].length > 0) {
						for (const errorCase of data.errors[errorCode]) {
							const field = errorCase.slice(errorCase.lastIndexOf("-") + 1);
							const input = form.querySelector(`#input-${assignment}-${field}`);
							if (input) input.classList.add("error");
						}
					}
				}

				for (const field in data.additionalData) {
					const output = section.querySelector(`#output-${assignment}-${field}`);
					if (output) {
						output.textContent = data.additionalData[field] ? data.additionalData[field] : "...";
					}
				}
				break;
			case "e3":
				data = await sendRequest(assignment, info);
				break;
			case "e4":
				data = await sendRequest(assignment, info);
				break;
			case "m1":
				data = await sendRequest(assignment, info);
				break;
			case "m2":
				data = await sendRequest(assignment, info);
				break;
			case "m3":
				data = await sendRequest(assignment, info);
				break;
			case "h1":
				data = await sendRequest(assignment, info);
				break;
			case "c1":
				data = await sendRequest(assignment, info);
				break;
			default:
				console.warn(`We haven't implemented the assignment ${assignment} yet.`);
				break;
		}
	} catch (error) {
		return console.error("Error processing assignment:", error);
	}
}
