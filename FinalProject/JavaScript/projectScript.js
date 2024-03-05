// Form validation for Posting Project
var projectForm = document.querySelector("#projectForm");
projectForm.addEventListener("submit", projectFormValid);

function projectFormValid(event) {
	let isFilledOut = true;
	
	if (projectForm.projectTitle.value === "") {
		isFilledOut = false;
		projectForm.projectTitle.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if (!projectForm.github.value.includes("github.com")) {
		isFilledOut = false;
		projectForm.github.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if (projectForm.projectDescription.value === "") {
		isFilledOut = false;
		projectForm.projectDescription.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if (projectForm.skillsList.selectedIndex === -1) {
		isFilledOut = false;
		projectForm.skillsList.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = document.querySelector("#projectError");
	if (isFilledOut === false) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

projectForm.projectTitle.addEventListener("keypress", resetField);
projectForm.projectDescription.addEventListener("keypress", resetField);
projectForm.github.addEventListener("keypress", resetField);
projectForm.skillsList.addEventListener("focus", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}

// Counter for textfields
projectForm.projectDescription.addEventListener("input", countChars);

function countChars(event) {
	document.getElementById("projectCounter").innerHTML = event.target.value.length + " Character Entered";
}

// Add event listener to the delete button
$delete = $("#delete");
$delete.click(deletePost);

// Delete post on delete button click
function deletePost() {
	$.ajax({
		url: "../PHP/Project.php", //Used to delete data in database
		method: "DELETE"
	}).done(function() {
		alert("Post Deleted");
		window.location.reload();
	});
}
