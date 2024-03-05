// Form validation for Weekly Challenge
var weeklyForm = document.querySelector("#weeklyForm");
weeklyForm.addEventListener("submit", weeklyFormValid);

function weeklyFormValid(event) {
	let isFilledOut = true;
	
	if(weeklyForm.weeklyTitle.value === "") {
		isFilledOut = false;
		weeklyForm.weeklyTitle.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(weeklyForm.discussionBody.value === "") {
		isFilledOut = false;
		weeklyForm.discussionBody.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = document.querySelector("#weeklyError");
	if (isFilledOut === false) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

weeklyForm.weeklyTitle.addEventListener("keypress", resetField);
weeklyForm.discussionBody.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}

// Counter for textfields
weeklyForm.discussionBody.addEventListener("input", countChars);

function countChars(event) {
	document.getElementById("weeklyCounter").innerHTML = event.target.value.length + " Character Entered";
}

// Add event listener to the delete button
$delete = $("#delete");
$delete.click(deletePost);

// Delete post on delete button click
function deletePost() {
	$.ajax({
		url: "../PHP/Challenge.php", //Used to delete data in database
		method: "DELETE"
	}).done(function() {
		alert("Post Deleted");
		window.location.reload();
	});
}