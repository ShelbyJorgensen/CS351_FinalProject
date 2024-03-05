<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/jobScript.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<title>Jobs</title>
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
		
		if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['username'])) {
			$jobTitle =  test_input($_POST["jobTitle"]);
			$jobLocation = test_input($_POST["jobLocation"]);
			$jobURL = test_input($_POST["jobURL"]);
			$username = $_COOKIE['username'];
			
			// Only insert data when all fields have a value in them
			if(strlen($jobTitle) > 0 && strlen($jobLocation) > 0 && strlen($jobURL) > 0) {
				$select = "SELECT * FROM jobs";
				$result = $conn->query($select);
				
				$sql = "INSERT INTO jobs (job_title, job_location, job_url, username) VALUES( '$jobTitle', '$jobLocation', '$jobURL', '$username')";
				// Allow insertion if the DB is empty`
				if ($result->num_rows === 0 ) {
					mysqli_query($conn, $sql);
				}
				// Otherwise check the DB for dubplicate values before posting 
				if ($result->num_rows > 0) {
					$canStore = True;
					while($row = $result->fetch_assoc()) {
						if($row["job_title"] === $jobTitle && $row["job_location"] === $jobLocation && $row["job_url"] === $jobURL) {
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
			$sql = "DELETE FROM jobs WHERE username = '$username';";
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
			<h1>Find a Job</h1>
			<a href="Login.php"><input type="submit" value="Login" id="Login"></a>
		</div>
		<nav>
			<a></a>
			<a href="Project.php">Projects</a>
			<a href="Networking.php">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
			<a href="#">Jobs</a>
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
			<h2>Share a Job</h2>
			<br>
			<form id="jobForm" method="post" action="#">
				<br>
				<label for="jobTitle">Job Title:</label><br>
				<input type="text" name="jobTitle" id="jobTitle"><br><br>
				<label for="jobLocation">Location:</label><br>
				<input type="text" name="jobLocation" id="jobLocation"><br><br>
				<label for="jobURL">Job Link:</label><br>
				<input type="text" name="jobURL" id="jobURL"><br><br>
				<input type="submit" value="Post"><br>
				<?php
					if(!isset($_COOKIE['username'])) {
						echo "<p class=\"error\" id=\"weeklyError\">Must be logged in to post.</p>";
					}
				?>
				<p class="error" id="jobError"></p><br>
			</form>
			<br>
			<h3>Need help finding a job, or prepairing for an interview? Visit <a href="https://www.cwu.edu/academics/academic-resources/career-services/" target="_blank" style="color: black;"> CWU Career Services</a> to get the help you need.</h3>
			<br>
			<h2>See Jobs From the Community</h2>
			<br>
			<?php
				$select = "SELECT * FROM jobs ORDER BY jobNumber DESC";
				$result = $conn->query($select);
				
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<br><div class="pastPosts">';
						echo '<h3>' . $row["job_title"] . '</h3>';
						echo '<h4>' . $row["job_location"] . '</h4>';
						echo '<p>' . $row["job_url"] . '</p>';
						
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