<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/joinScript.js" defer></script>
		<title>Create Account</title>
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
			
			$canStore = True;

			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$username = test_input($_POST['userName']);
				// Clean user password input, then hash the password
				$password = test_input($_POST['password']);
				$password = password_hash($password, PASSWORD_BCRYPT);
				$name = test_input($_POST['name']);
				$year = test_input($_POST['year']);
				$userSkills = array();
				
				
				$sendPhoto = False;
				// Only try to process a photo if one is uploaded
				$filename = $_FILES["uploadfile"]["name"];
				$temp = $_FILES["uploadfile"]["tmp_name"];
				$folder = "../UserImages/" . $filename;
				$sendPhoto = True;
				
				// Check that a skill has been selected
				if(isset($_POST["skills"])) {
					foreach($_POST["skills"] as $skill) {
						array_push($userSkills, "$skill");
					}
					$userSkills = implode(", ", $userSkills);
				}
				
				
				// Only insert data when all fields have a value in them
				if(strlen($username) > 0 && strlen($password) > 0 && strlen($name) > 0) {
					$select = "SELECT * FROM users";
					$result = $conn->query($select);
					
					// Create SQL insert
					if($sendPhoto) {
						$sql = "INSERT INTO users(username, password, name, year, skills, image) VALUES('$username', '$password', '$name', '$year', '$userSkills', '$filename')";
					} else {
						$sql = "INSERT INTO users(username, password, name, year, skills, image) VALUES('$username', '$password', '$name', '$year', '$userSkills', '')";
					}
					
					// Allow insertion if the DB is empty`
					if ($result->num_rows === 0 ) {
						mysqli_query($conn, $sql);
					}
					// Otherwise check the DB for dubplicate values before posting 
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row["username"] === $username) {
								$canStore = False;
							}
						}
						if ($canStore) {
							mysqli_query($conn, $sql);
						}
					}
					if($sendPhoto) {
						move_uploaded_file($temp, $folder);
					}
					
					// If an account was created successfully, redirect the user to login page to login and establish cookies
					if($sendPhoto && $canStore) {
						header("Location: ./Login.php");
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
			<h2>Create Your Profile</h2>
			<form id="joinForm" method="post" action="#" enctype="multipart/form-data">
				<br>
				<label for="joinUserName">User Name</label><br>
				<input type="text" name="userName" id="joinUserName">
				<br><br>
				<label for="joinPassword">Password</label><br>
				<input type="password" name="password" id="joinPassword">
				<br><br>
				<label for="joinName">Name</label><br>
				<input type="text" name="name" id="joinName">
				<br><br>
				<label for="year">Graduation Year</label><br>
				<input type="number" name="year" id="year" value="2024">
				<br><br>
				<select name="skills[]" id="joinSkillsList" multiple size="8">
					<option value="Java">Java</option>
					<option value="Python">Python</option>
					<option value="C/C++">C/C++</option>
					<option value="JavaScipt">JavaScript</option>
					<option value="Node.js">Node.js</option>
					<option value="SQL">SQL</option>
					<option value="Go">Go</option>
					<option value="PHP">PHP</option>
				</select><br><br>
				<label for="profilePhoto">Upload a Profile Picture</label>
				<input type="file" name="uploadfile" id="profilePhoto" accept=".png,.jpg,.gif">
				<br><br>
				<input type="submit" value="Join"><br>
				<p class="error" id="joinError"></p><br>
				<?php 
					if(!$canStore) {
						echo "<p class=\"error\">User name taken, please try a different user name</p>";
					}
				?>
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