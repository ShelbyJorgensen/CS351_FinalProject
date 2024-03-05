// Form validation for Login
var usernameForm = document.querySelector("#usernameForm");
usernameForm.addEventListener("submit", usernameFormValid);

function usernameFormValid(event) {
	let isFilledOut = true;
	
	if(usernameForm.oldUsername.value === "") {
		isFilledOut = false;
		usernameForm.oldUsername.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(usernameForm.newUsername.value === "") {
		isFilledOut = false;
		usernameForm.newUsername.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(usernameForm.confirmUsername.value === "") {
		isFilledOut = false;
		usernameForm.confirmUsername.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = document.querySelector("#loginError");
	if (isFilledOut === false) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

usernameForm.oldUsername.addEventListener("keypress", resetField);
usernameForm.newUsername.addEventListener("keypress", resetField);
usernameForm.confirmUsername.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}
