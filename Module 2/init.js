const minimizedElementList = document.querySelectorAll(".minimized");
const minimizeButtonList = document.querySelectorAll(".minimize");
const asideElement = document.querySelector("aside");
const maxWidth = document.documentElement.clientWidth;
const mouseXThresholdLarge = maxWidth * 0.25;
const mouseXThresholdSmall = maxWidth * 0.1;
const resultE1 = document.querySelector("#result-e1");
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
				data = await processAssignment(assignment, info);
				break;
			case "e2":
				data = await processAssignment(assignment, info);
				break;
			case "e3":
				data = await processAssignment(assignment, info);
				break;
			case "e4":
				data = await processAssignment(assignment, info);
				break;
			case "m1":
				data = await processAssignment(assignment, info);
				break;
			case "m2":
				data = await processAssignment(assignment, info);
				break;
			case "m3":
				data = await processAssignment(assignment, info);
				break;
			case "h1":
				data = await processAssignment(assignment, info);
				break;
			case "c1":
				data = await processAssignment(assignment, info);
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
