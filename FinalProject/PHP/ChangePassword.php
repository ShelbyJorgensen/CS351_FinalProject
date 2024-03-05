<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/changePasswordScript.js" defer></script>
		<title>Change Password</title>
		<link id="favicon" rel="icon" href="../Images/cwuFavicon.png">
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "csclub";
			
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$oldPassword = test_input($_POST['oldPassword']);
				$newPassword = test_input($_POST['newPassword']);
				$confirmPassword = test_input($_POST['confirmPassword']);
				
				$select = "SELECT password FROM users WHERE username = '$_COOKIE[username]';";
				$result = $conn->query($select);
				
				while($row = $result->fetch_assoc()) {
					if(password_verify($oldPassword, $row['password']) && $newPassword === $confirmPassword) {
						// Hash new password, then update the new password in the database
						$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
						$update = "UPDATE users SET password = '$newPassword' WHERE username = '$_COOKIE[username]';";
						$conn->query($update);
						header("Location: User.php");
					}
				}
			}
			
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		?>
		<div class="image">
			<a href="../Index.php"><img src="../Images/CWULogo.jpg" alt="CWU Logo" id="Logo"></a>
			<img src="../Images/CWUCampus.jpg" alt="Barge Hall on CWU campus" id="headImg">
			<h1>Change Password</h1>
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
					<a href="Contact.php">Contact Us</a><br><br>
					<a href="User.php">Profile</a><br><br>
				</div>
			</div>
			<a></a>
			<a></a>
		</nav>
		<div class="content">
			<br>
			<br><br>
			<form id="changePasswordForm" method="post" action="#">
				<br>
				<label for="oldPassword">Old Password</label><br>
				<input type="password" name="oldPassword" id="oldPassword">
				<br><br>
				<label for="newPassword">New Password</label><br>
				<input type="password" name="newPassword" id="newPassword">
				<br><br>
				<label for="confirmPassword">Confirm New Password</label><br>
				<input type="password" name="confirmPassword" id="confirmPassword">
				<br><br>
				<input type="submit" value="Change"><br>
				<p class="error" id="passwordError"></p><br>
			</form>
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
			<a href="Contact.php">Contact Us</a>
			<a href="User.php">Profile</a>
		</div>
	</footer>
</html>