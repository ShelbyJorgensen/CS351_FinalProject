<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/contactScript.js" defer></script>
		<title>Contact Us</title>
		<link id="favicon" rel="icon" href="../Images/cwuFavicon.png">
	</head>
	<body>
		<?php
			$isSent = False;
			
			// Check if the send button was pressed
			if(isset($_POST['Send'])) {
				// Gather email contents from form
				$email = "cwudmcsc@gmail.com";
				$title = $_POST['emailTitle'];
				$body = $_POST['emailBody'];
				$from = "From: " . $_POST['contactEmail'];
				
				// Use mail() to send email to support email, track is sent for success message
				mail($email, $title, $body, $from);
				$isSent = True;
			}
		?>
		<div class="image">
			<a href="../Index.php"><img src="../Images/CWULogo.jpg" alt="CWU Logo" id="Logo"></a>
			<img src="../Images/CWUCampus.jpg" alt="Barge Hall on CWU campus" id="headImg">
			<h1>Reach Out</h1>
			<a href="Login.php"><input type="submit" value="Login" id="Login"></a>
		</div>
		<nav>
			<a></a>
			<a href="Project.php">Projects</a>
			<a href="Networking.php">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
			<a href="Jobs.php">Jobs</a>
			<div class="dropdown">
				<span>More</span>
				<div class="dropdown-content">
					<a href="../Subpages/About.html">About Us</a><br><br>
					<a href="#">Contact Us</a><br><br>
					<a href="User.php">Profile</a><br><br>
				</div>
			</div>
			<a></a>
			<a></a>
		</nav>
		<div class="content">
			<br><br>
			<h2>Contact Us</h2>
			<div id="contact">
				<p>If you have any questions, please send us an email blow, or reach out to us at <a href="mailto:CWUDMCSC@gmail.com">CWUDMCSC@gmail.com</a></p>
			</div>
			<form id="contactForm" method="post" action="#">
				<br>
				<label for="contactEmail">Email:</label><br>
				<input type="email" name="contactEmail" id="contactEmail"><br><br>
				<label for="emailTitle">Title:</label><br>
				<input type="text" name="emailTitle" id="emailTitle"><br><br><br>
				<textarea rows="8" name="emailBody" id="emailBody"></textarea><br>
				<p class="counter" id="emailCounter"></p>
				<br>
				<input type="submit" name="Send" value="Send"><br>
				<p class="error" id="contactError"></p><br>
			</form>
			<?php
				if($isSent) {
					echo "<h3>Message Sent! A member of our team will reach out to you as soon as possible</h3>";
				}
			?>
			<br><br>
		</div>
	</body>
	<footer>
		<p id="footerText">Created in partnership with Central Washington University, Des Moines</p><br>
		<div id="footerNav">
			<a href="../Index.php">Home</a>
			<a href="Project.php">Projects</a>
			<a href="Networking.php">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
			<a href="Jobs.php">Jobs</a>
			<a href="../Subpages/About.html">About Us</a>
			<a href="#">Contact Us</a>
			<a href="User.php">Profile</a>
		</div>
	</footer>
</html>