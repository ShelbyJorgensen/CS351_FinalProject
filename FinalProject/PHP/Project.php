<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="../CSS/styles.css" rel="stylesheet">
		<script src="../JavaScript/projectScript.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<title>Projects</title>
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
			
			if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['projectID']) && isset($_COOKIE['username'])) {
				$joinProject = test_input($_POST['projectID']);
				$username = $_COOKIE['username'];
				
				$joined = "SELECT projects FROM users WHERE username = '$username';";
				$numProjects = $conn->query($joined);
				
				if ($numProjects->num_rows !== 0) {
					while($pastProjects = $numProjects->fetch_assoc()) {
						$joinProject = $pastProjects['projects'] . ", " . $joinProject;
					}
				}
				
				$add = "UPDATE users SET projects = '$joinProject' WHERE username = '$username';";
				$conn->query($add);
			}
			
			// If form is posted, start process of saving post data to database
			if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["projectTitle"]) && isset($_COOKIE['username'])) {
				
				$projectTitle = test_input($_POST["projectTitle"]);
				$projectLink = test_input($_POST["github"]);
				$projectDescription = test_input($_POST["projectDescription"]);
				$projectSkills = array();
				$loggedIn = False;
				
				// Check if the username is set on log-in, otherwise will ask user to log in to post
				if(isset($_COOKIE['username'])) {
					$loggedIn = True;
				}
				
				
				// Check that a skill has been selected
				if(isset($_POST["skills"])) {
					foreach($_POST["skills"] as $skill) {
						array_push($projectSkills, "$skill");
					}
					$projectSkills = implode(", ", $projectSkills);
				}
				
				// Only insert data when all fields have a value in them
				if(strlen($projectTitle) > 0 && strlen($projectLink) > 0 && strlen($projectDescription) > 0 && $loggedIn) {
					$select = "SELECT * FROM project";
					$result = $conn->query($select);
					
					// Create SQL insert
					$sql = "INSERT INTO project(title, link, skills, description, username) VALUES ('$projectTitle', '$projectLink', '$projectSkills', '$projectDescription', '$_COOKIE[username]')";
					
					// Allow insertion if the DB is empty`
					if ($result->num_rows === 0 ) {
						mysqli_query($conn, $sql);
					}
					// Otherwise check the DB for dubplicate values before posting 
					if ($result->num_rows > 0) {
						$canStore = True;
						while($row = $result->fetch_assoc()) {
							if($row["title"] === $projectTitle && $row["link"] === $projectLink && $row["description"] === $projectDescription) {
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
				$sql = "DELETE FROM project WHERE username = '$username';";
				$conn->query($sql);
			}
			
			
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			end:
		?>
		<div class="image">
			<a href="../Index.php"><img src="../Images/CWULogo.jpg" alt="CWU Logo" id="Logo"></a>
			<img src="../Images/CWUCampus.jpg" alt="Barge Hall on CWU campus" id="headImg">
			<h1>Join a Project</h1>
			<a href="Login.php"><input type="submit" value="Login" id="Login"></a>
		</div>
		<nav>
			<a></a>
			<a href="#">Projects</a>
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
			<h2>Post Your Project</h2>
			<br>
			<form id="projectForm" method="post" action="Project.php">
				<br>
				<label for="projectTitle">Project Title</label><br>
				<input type="text" name="projectTitle" id="projectTitle"><br><br>
				<label for="github">GitHub Link</label><br>
				<input type="text" name="github" id="github"><br><br>
				<label for="skillsList">Skills</label><br>
				<select name="skills[]" id="skillsList" multiple size="8">
					<option value="Java">Java</option>
					<option value="Python">Python</option>
					<option value="C/C++">C/C++</option>
					<option value="JavaScipt">JavaScript</option>
					<option value="Node.js">Node.js</option>
					<option value="SQL">SQL</option>
					<option value="Go">Go</option>
					<option value="PHP">PHP</option>
				</select><br><br>
				<label for="projectDescription">Project Description</label><br>
				<textarea id="projectDescription" name="projectDescription" rows="6"></textarea><br><br>
				<p class="counter" id="projectCounter"></p>
				<input type="submit" value="Post Project" id="postProject" name="postProject" style="width:20%"><br>
				<?php
					if(!isset($_COOKIE['username'])) {
						echo "<p class=\"error\" id=\"weeklyError\">Must be logged in to post.</p>";
					}
				?>
				<p id="projectError" class="error"></p>
				<br>
			</form>
			<br><br>
			<h2>Learn About the Projects</h2><br>
			<?php
				$select = "SELECT * FROM project ORDER BY project_id DESC;";
				$result = $conn->query($select);
				
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<br><div class="pastPosts">';
						echo '<h3>' . $row["title"] . '</h3>';
						echo '<h4>' . $row["link"] . '</h4>';
						echo '<h4>' . $row["skills"] . '</h4>';
						echo '<p>' . $row["description"] . '</p><br>';
						
						// Only allow user that created post to delete it
						if(isset($_COOKIE['username'])) {
							if($row["username"] === $_COOKIE['username']) {
								echo '<button name="delete" class="discussion" id="delete">Delete</button>';
							}
						}
						echo '</form></div><br>';
					}
				}
			?>
			<br><br>
			<h2>Join a Project</h2><br>
			<form name="joinForm" method="post" action="Project.php">
				<br>
				<select name="projectID" id="projects">
					<?php
						$sql = "SELECT * FROM project;";
						$projects = $conn->query($sql);
						while($project = $projects->fetch_assoc()) {
							echo '<option value="' . $project['title'] . '">' . $project['title'] . '</option>';
						}
					?>
				</select><br><br>
				<input type="submit" name="joinProject" value="Join"><br><br>
			</form>
			<br><br>
			<br><br>
		</div>
	</body>
	<footer>
		<p id="footerText">Created in partnership with Central Washington University, Des Moines</p><br>
		<div id="footerNav">
			<a href="../Index.php">Home</a>
			<a href="#">Projects</a>
			<a href="Networking.php">Networking</a>
			<a href="Challenge.php">Weekly Challenge</a>
		    <a href="Jobs.php">Jobs</a>
			<a href="../Subpages/About.html">About Us</a>
			<a href="Contact.php">Contact Us</a>
			<a href="User.php">Profile</a>
		</div>
	</footer>
</html>