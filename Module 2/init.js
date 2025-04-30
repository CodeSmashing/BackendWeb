const minimizedElementList = document.querySelectorAll(".minimized");
const minimizeButtonList = document.querySelectorAll(".minimize");
const formList = document.querySelectorAll("form");
const asideElement = document.querySelector("aside");
const maxWidth = document.documentElement.clientWidth;
const mouseXThresholdLarge = 200;
const mouseXThresholdSmall = 20;
const resultE1A = document.querySelector("#result-e1-a");
const resultE1B = document.querySelector("#result-e1-b");
const resultE1C = document.querySelector("#result-e1-c");
const resultE2 = document.querySelector("#result-e2");
const resultE3 = document.querySelector("#result-e3");
const resultE4 = document.querySelector("#result-e4");
const resultM1 = document.querySelector("#result-m1");
const resultM2 = document.querySelector("#result-m2");
const resultM3 = document.querySelector("#result-m3");
const resultH1 = document.querySelector("#result-h1");
const resultC1 = document.querySelector("#result-c1");
let assignment = document.querySelector("#assignment").value;

minimizedElementList.forEach((element) => {
	element.scrollTop = 0;
});

minimizeButtonList.forEach((button) => {
	button.addEventListener("click", toggleMinimization);
});

formList.forEach((form) => {
	form.addEventListener("submit", submitForm);
})

document.addEventListener("mousemove", handleAsideVisibility);
asideElement.addEventListener("click", handleAsideClick);

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

function validateForm(form) {
	// Check if form input meets required conditions before sending it to process.php
	const inputs = Array.from(form.querySelectorAll("input"));
	
	const selectorUsername = inputs.find((input) => input.id.includes("-username"));
	const selectorPassword = inputs.find((input) => input.id.includes("-password") && input.id.slice(-1) !== "-");
	const selectorPasswordConfirm = inputs.find((input) => input.id.includes("-confirm"));

	const inputUsername = selectorUsername.value.trim();
	const inputPassword = selectorPassword.value.trim();
	const inputPasswordConfirm = selectorPasswordConfirm ? selectorPasswordConfirm.value.trim() : undefined;

	const regExpUsername = /^(?=.*[\w.])[\w.]{4,25}$/;
	const regExpPassword = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$/;

	if (inputUsername == undefined || regExpUsername.test(inputUsername) === false) {
		selectorUsername.classList.add("error");
		return false;
	}

	if (inputPassword == undefined || regExpPassword.test(inputPassword) === false) {
		selectorPassword.classList.add("error");
		return false;
	}

	if (selectorPasswordConfirm) {
		if (inputPasswordConfirm == undefined || regExpPassword.test(inputPasswordConfirm) === false) {
			selectorPassword.classList.add("error");
			selectorPasswordConfirm.classList.add("error");
			return false;
		}

		if (inputPassword !== inputPasswordConfirm) {
			selectorPassword.classList.add("error");
			selectorPasswordConfirm.classList.add("error");
			return false;
		}
	}

	return {inputUsername, inputPassword};
}

function submitForm(event) {
	event.preventDefault();
	const form = event.target;
	const action = event.submitter.dataset.action;
	const actionMessages = {
		"sign-in": "Requesting sign in...",
		"sign-up": "Requesting sign up...",
		"password-reset": "Requesting password reset...",
	};
	const validationResults = validateForm(form);

	if (!validationResults) {
		return console.warn("Form was incorrectly filled in.");
	}

	updateResults({message: actionMessages[action], action, username: validationResults.inputUsername, password: validationResults.inputPassword });
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
			console.log("The response:", response);
			return response;
		})
		.catch((error) => {
			console.error("Error occurred:", error);
		});
}

async function updateResults(info = {}) {
	let data = {};
	let htmlString = "";

	if (!assignment || typeof assignment !== "string") return console.warn("Invalid or undefined assignment identifier.");
	try {
		switch (assignment) {
			case "e1":
				if (!info.username || !info.password) return console.warn("Username and password are needed.");
				
				data = await sendRequest(assignment, info);
				if (!data) return console.warn("No data returned from the server.");
				if (!data.success) return console.warn(`${data.exitReason}: ${data.serverMessage}`);

				resultE1A.textContent = info.username;
				resultE1B.textContent = info.password;
				resultE1C.textContent = data.hash;
				break;
			case "e2":
				data = await sendRequest(assignment, info);
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

updateResults();
