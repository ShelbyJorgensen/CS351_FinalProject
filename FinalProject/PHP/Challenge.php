<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/weeklyScript.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<title>Weekly Challenge</title>
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
				$weeklyTitle = test_input($_POST['weeklyTitle']);
				$userName = $_COOKIE['username'];
				$postBody = test_input($_POST['body']);
				
				// Only insert data when all fields have a value in them
				if(strlen($weeklyTitle) > 0 && strlen($userName) > 0 && strlen($postBody) > 0) {
					$select = "SELECT * FROM challenge";
					$result = $conn->query($select);
					
					// Create SQL insert
					$sql = "INSERT INTO challenge(title, username, body) VALUES('$weeklyTitle', '$userName', '$postBody')";
					
					// Allow insertion if the DB is empty`
					if ($result->num_rows === 0 ) {
						mysqli_query($conn, $sql);
					}
					// Otherwise check the DB for dubplicate values before posting 
					if ($result->num_rows > 0) {
						$canStore = True;
						while($row = $result->fetch_assoc()) {
							if($row["title"] === $weeklyTitle && $row["username"] === $userName && $row["body"] === $postBody) {
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
				$sql = "DELETE FROM challenge WHERE username = '$username';";
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
			<h1>Weekly Coding Challenge</h1>
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
			<h2>This Week's Challenge</h2>
			<iframe src="https://leetcode.com/problems/number-of-submatrices-that-sum-to-target/description/?envType=daily-question&envId=2024-02-04" title="Weekly Leetcode Problem" width="90%" height="1000"></iframe>
			<br><br>
			<h3>Want more challenges? Visit <a href="https://leetcode.com/problemset/" style="color: black;" target="_blank">LeetCode</a> to find more problems.</h3>
			<br>
			<h2>Post Your Thoughts</h2>
			<br>
			<form id="weeklyForm" method="post" action="#">
				<br>
				<label for="weeklyTitle">Title</label><br>
				<input type="text" name="weeklyTitle" id="weeklyTitle"><br><br>
				<textarea rows="7" cols="50" name="body" id="discussionBody"></textarea><br>
				<p class="counter" id="weeklyCounter"></p>
				<br>
				<input type="submit" name="submit" value="Post"><br>
				<?php
					if(!isset($_COOKIE['username'])) {
						echo "<p class=\"error\" id=\"weeklyError\">Must be logged in to post.</p>";
					}
				?>
				<p class="error" id="weeklyError"></p><br>
			</form><br>
			<h2>Get Help From the Community</h2><br>
			<?php
				$select = "SELECT * FROM challenge ORDER BY post_ID DESC";
				$result = $conn->query($select);
				
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<br><div class="pastPosts">';
						echo '<h3>' . $row["title"] . '</h3>';
						echo '<h4>' . $row["username"] . '</h4>';
						echo '<p>' . $row["body"] . '</p>';
						
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
			<a href="Networking.php">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
			<a href="Jobs.php">Jobs</a>
			<a href="../Subpages/About.html">About Us</a>
			<a href="Contact.php">Contact Us</a>
			<a href="User.php">Profile</a>
		</div>
	</footer>
</html>