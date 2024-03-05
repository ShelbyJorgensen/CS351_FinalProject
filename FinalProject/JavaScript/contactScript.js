// Form validation for Contact page
var contactForm = document.querySelector("#contactForm");
contactForm.addEventListener("submit", contactFormValid);

function contactFormValid(event) {
	let isFilledOut = true;
	
	if(contactForm.contactEmail.value === "") {
		isFilledOut = false;
		contactForm.contactEmail.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(contactForm.emailTitle.value === "") {
		isFilledOut = false;
		contactForm.emailTitle.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	if(contactForm.emailBody.value === "") {
		isFilledOut = false;
		contactForm.emailBody.style.backgroundColor = "#e0a2b2";
		event.preventDefault();
	}
	
	let error = document.querySelector("#contactError");
	if (isFilledOut === false) {
		error.innerHTML = "Please fill in all fields before posting a project";
		event.preventDefault();
	} else {
		error.innerHTML = "";
	}
}

contactForm.contactEmail.addEventListener("keypress", resetField);
contactForm.emailTitle.addEventListener("keypress", resetField);
contactForm.emailBody.addEventListener("keypress", resetField);

// Function to reset field background to orginial color, used by all fields
function resetField(event) {
		this.style.backgroundColor = "white";
}

// Counter for textfields
contactForm.emailBody.addEventListener("input", countChars);

function countChars(event) {
	document.getElementById("emailCounter").innerHTML = event.target.value.length + " Character Entered";
}