// Form validation for Login
var loginForm = document.querySelector("#loginForm");
loginForm.addEventListener("submit", loginFormValid);

function loginFormValid(event) {
	let isFilledOut = true;
	
	if(loginForm.loginName.value === "") {
		isFilledOut = false;
		loginForm.loginName.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(loginForm.loginPassword.value === "") {
		isFilledOut = false;
		loginForm.loginPassword.style.backgroundColor = "#e0a2b2";
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

loginForm.loginName.addEventListener("keypress", resetField);
loginForm.loginPassword.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}
