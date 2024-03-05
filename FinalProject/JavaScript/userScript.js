// Add event listener to the delete button
$deleteButn = $("#deleteButn");
$deleteButn.click(deleteProfile);


function deleteProfile() {
	$.ajax({
		url: "../PHP/deleteProfile.php", //Used to delete data in database
		method: "DELETE"
	}).done(function() {
		alert("Profile Deleted");
		window.location.replace("../Index.html");
	});
}