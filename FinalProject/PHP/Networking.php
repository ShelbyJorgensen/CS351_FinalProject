<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/networkScript.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<title>Networking</title>
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
		
		if($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_COOKIE['username'])) {
			$netName =  test_input($_POST["netName"]);
			$year = test_input($_POST["year"]);
			$profileLinks = test_input($_POST["profileLinks"]);
			$username = $_COOKIE['username'];
			
			// Only insert data when all fields have a value in them
			if(strlen($netName) > 0 && $year > 0 && strlen($profileLinks) > 0) {
				$select = "SELECT * FROM network";
				$result = $conn->query($select);
				
				$sql = "INSERT INTO network (name, grad_year, profile_links, username) VALUES('$netName', '$year', '$profileLinks', '$username')";
				// Allow insertion if the DB is empty`
				if ($result->num_rows === 0 ) {
					mysqli_query($conn, $sql);
				}
				// Otherwise check the DB for dubplicate values before posting 
				if ($result->num_rows > 0) {
					$canStore = True;
					while($row = $result->fetch_assoc()) {
						if($row["name"] === $netName && $row["grad_year"] === $year && $row["profile_links"] === $profileLinks) {
							$canStore = False;
						}
					}
					if ($canStore) {
						mysqli_query($conn, $sql);
					}
				}
			}
		}
		
		// If delete request is sent by the delete post button
		if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			$username = $_COOKIE['username'];
			$sql = "DELETE FROM network WHERE username = '$username';";
			$conn->query($sql);
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
			<h1>Build Your Network</h1>
			<a href="Login.php"><input type="submit" value="Login" id="Login"></a>
		</div>
		<nav>
			<a></a>
			<a href="Project.php">Projects</a>
			<a href="#">Networking</a>
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
			<h2>Share Your Information</h2>
			<br>
			<form id="networkingForm" method="post" action="#">
				<br>
				<label for="netName">Your Name</label><br>
				<input type="text" name="netName" id="netName"><br><br>
				<label for="year">Graduation Year</label><br>
				<input type="number" name="year" id="year" value="2024"><br><br>
				<label for="profileLinks">Profile Links</label>
				<textarea name="profileLinks" rows="7" cols="50" id="profileLinks"></textarea><br>
				<p class="counter" id="profileCounter"></p>
				<br>
				<input type="submit" value="Post"><br>
				<?php
					if(!isset($_COOKIE['username'])) {
						echo "<p class=\"error\" id=\"weeklyError\">Must be logged in to post.</p>";
					}
				?>
				<p class="error" id="networkError"></p><br>
			</form>
			<h2>Build Your Network With Us</h2>
			<?php
				$select = "SELECT * FROM network ORDER BY network_ID DESC";
				$result = $conn->query($select);
				
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<br><div class="pastPosts">';
						echo '<h3>' . $row["name"] . '</h3>';
						echo '<h4>' . $row["grad_year"] . '</h4>';
						echo '<p>' . $row["profile_links"] . '</p>';
						
						// Only allow user that created post to delete it
						if(isset($_COOKIE['username'])) {
							if($row["username"] === $_COOKIE['username']) {
								echo '<button name="delete" class="discussion" id="delete">Delete</button>';
							}
						}
						
						echo '</div><br>';
					}
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
			<a href="#">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
			<a href="Jobs.php">Jobs</a>
			<a href="../Subpages/About.html">About Us</a>
			<a href="Contact.php">Contact Us</a>
			<a href="User.php">Profile</a>
		</div>
	</footer>
</html>