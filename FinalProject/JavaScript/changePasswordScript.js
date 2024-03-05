// Form validation for Login
var changePasswordForm = document.querySelector("#changePasswordForm");
changePasswordForm.addEventListener("submit", passwordFormValid);

function passwordFormValid(event) {
	let isFilledOut = true;
	let tooShort = false;
	let notMatching = false;
	
	if(changePasswordForm.oldPassword.value === "") {
		isFilledOut = false;
		changePasswordForm.oldPassword.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(changePasswordForm.newPassword.value === "") {
		isFilledOut = false;
		changePasswordForm.newPassword.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(changePasswordForm.newPassword.value.length < 8) {
		tooShort = true;
		changePasswordForm.newPassword.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(changePasswordForm.confirmPassword.value === "") {
		isFilledOut = false;
		changePasswordForm.confirmPassword.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(changePasswordForm.newPassword.value != changePasswordForm.confirmPassword.value) {
		notMatching = true;
		changePasswordForm.newPassword.style.backgroundColor = "#e0a2b2";
		changePasswordForm.confirmPassword.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = document.querySelector("#passwordError");
	if (isFilledOut === false) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else if (tooShort === true) {
		error.innerHTML = "Password must be at least 8 characters long";
		event.preventDefault();
	} else if (notMatching === true) {
		error.innerHTML = "Please enter your new password and conifrm the new password are the same";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

changePasswordForm.oldPassword.addEventListener("keypress", resetField);
changePasswordForm.newPassword.addEventListener("keypress", resetField);
changePasswordForm.confirmPassword.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}
