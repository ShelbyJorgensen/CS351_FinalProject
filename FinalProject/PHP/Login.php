<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/loginScript.js" defer></script>
		<title>Login</title>
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
			
			$loggedIn = False;
			
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$username = test_input($_POST['name']);
				$password = test_input($_POST['password']);
				
				$select = "SELECT username, password FROM users";
				$result = $conn->query($select);
				
				while($row = $result->fetch_assoc()) {
					if($row["username"] === $username && password_verify($password, $row['password'])) {
						setcookie("username", $username, time() + 3600);
						$_COOKIE["username"] = $username;
						$loggedIn = True;
						header("Location: ../Index.php");
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
			<h1>Login</h1>
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
			<form id="loginForm" method="post" action="#">
				<br>
				<label for="loginName">User Name</label><br>
				<input type="text" name="name" id="loginName">
				<br><br>
				<label for="loginPassword">Password</label><br>
				<input type="password" name="password" id="loginPassword">
				<br><br>
				<input type="submit" value="Login"><br>
				<p class="error" id="loginError"></p><br>
			</form>
			<p style="margin-left:10%;">Not a member? Click here to join!</p>
			<a href="CreateProfile.php"><input type="submit" value="Join"></a>
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