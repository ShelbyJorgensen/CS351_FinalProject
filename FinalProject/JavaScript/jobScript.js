// Form validation for Jobs
var jobForm = document.querySelector("#jobForm");
jobForm.addEventListener("submit", jobFormValid);

function jobFormValid(event) {
	let isFilledOut = true;
	
	if(jobForm.jobTitle.value === "") {
		isFilledOut = false;
		jobForm.jobTitle.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(jobForm.jobLocation.value === "") {
		isFilledOut = false;
		jobForm.jobLocation.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(jobForm.jobURL.value === "") {
		isFilledOut = false;
		jobForm.jobURL.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = jobForm.querySelector("#jobError");
	if(!isFilledOut) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

jobForm.jobTitle.addEventListener("keypress", resetField);
jobForm.jobLocation.addEventListener("keypress", resetField);
jobForm.jobURL.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}

// Add event listener to the delete button
$delete = $("#delete");
$delete.click(deletePost);

// Delete post on delete button click
function deletePost() {
	$.ajax({
		url: "../PHP/Jobs.php", //Used to delete data in database
		method: "DELETE"
	}).done(function() {
		alert("Post Deleted");
		window.location.reload();
	});
}