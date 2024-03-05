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
	  
	echo $_COOKIE['username'] . "<br><br>"; 
	 
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$oldUsername = test_input($_POST['oldUsername']);
		$newUsername = test_input($_POST['newUsername']);
		$confirmUsername = test_input($_POST['confirmUsername']);
		
		$select = "SELECT username FROM users";
		$result = $conn->query($select);
		
		while($row = $result->fetch_assoc()) {
			if($row["username"] === $oldUsername && $row['username'] === $_COOKIE["username"] && $newUsername === $confirmUsername) {
				// Update the username in the database
				$update = "UPDATE users SET username = '$newUsername' WHERE username = '$oldUsername';";
				$conn->query($update);
						
				// Remove old cookie and update the username cookie, redirect to user page
				setcookie("username", "", time() - 36000, '/');
				setcookie("username", $newUsername, time() + 3600);
				$_COOKIE['username'] = $newUsername;
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
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/changeUsernameScript.js" defer></script>
		<title>Change Username</title>
		<link id="favicon" rel="icon" href="../Images/cwuFavicon.png">
	</head>
	<body>
		<div class="image">
			<a href="../Index.php"><img src="../Images/CWULogo.jpg" alt="CWU Logo" id="Logo"></a>
			<img src="../Images/CWUCampus.jpg" alt="Barge Hall on CWU campus" id="headImg">
			<h1>Change Username</h1>
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
			<br><br>
			<h2>Fill out the form below to change your username</h2>
			<br><br>
			<form id="usernameForm" method="post" action="#">
				<br>
				<label for="oldUsername">Old Username</label><br>
				<input type="text" name="oldUsername" id="oldUsername">
				<br><br>
				<label for="newUsername">New Username</label><br>
				<input type="text" name="newUsername" id="newUsername">
				<br><br>
				<label for="confirmUsername">Confirm New Username</label><br>
				<input type="text" name="confirmUsername" id="confirmUsername">
				<br><br>
				<input type="submit" value="Change"><br>
				<p class="error" id="loginError"></p><br>
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