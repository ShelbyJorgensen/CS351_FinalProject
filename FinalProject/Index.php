<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link href="CSS/styles.css" rel="stylesheet">
		<script src="JavaScript/script.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
		<title>CWU Des Moines: Computer Science Club</title>
		<link id="favicon" rel="icon" href="Images/cwuFavicon.png">
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
			
			// Create necessary database tables if not present
			$sql = "CREATE TABLE IF NOT EXISTS challenge (
						post_ID INT AUTO_INCREMENT,
						username VARCHAR(20),
						title VARCHAR(30),
						body VARCHAR(200),
						PRIMARY KEY(post_ID)
					);";
			$conn->query($sql);
			
			$sql = "CREATE TABLE IF NOT EXISTS jobs (
						jobNumber INT AUTO_INCREMENT,
						job_title VARCHAR(30),
						job_location VARCHAR(30),
						job_url VARCHAR(30),
						username VARCHAR(20),
						PRIMARY KEY(jobNumber)
					);";
			$conn->query($sql);
			
			$sql = "CREATE TABLE IF NOT EXISTS network (
						network_ID INT AUTO_INCREMENT,
						name VARCHAR(40),
						grad_year INT,
						profile_links VARCHAR(80),
						username VARCHAR(20),
						PRIMARY KEY(network_ID)
					);";
			$conn->query($sql);
			
			$sql = "CREATE TABLE IF NOT EXISTS project (
						project_ID INT AUTO_INCREMENT,
						title VARCHAR(30),
						link VARCHAR(50),
						skills VARCHAR(80),
						description VARCHAR(200),
						username VARCHAR(20),
						team_members VARCHAR(200),
						PRIMARY KEY(project_ID)
					);";
			$conn->query($sql);
			
			$sql = "CREATE TABLE IF NOT EXISTS users (
						userID INT AUTO_INCREMENT,
						username VARCHAR(20) UNIQUE,
						password VARCHAR(60),
						name VARCHAR(30),
						year INT,
						skills VARCHAR(80),
						image VARCHAR(50),
						projects VARCHAR(100),
						PRIMARY KEY(userID)
					);";
			$conn->query($sql);
		?>
		<div class="image">
			<a href="Index.php"><img src="Images/CWULogo.jpg" alt="CWU Logo" id="Logo"></a>
			<img src="Images/CWUCampus.jpg" alt="Barge Hall on CWU campus" id="headImg">
			<h1>CWU Des Moines Computer Science Club</h1>
			<a href="PHP/Login.php"><input type="submit" value="Login" id="Login"></a>
		</div>
		<nav>
			<a></a>
			<a href="PHP/Project.php">Projects</a>
			<a href="PHP/Networking.php">Networking</a>
			<a href="PHP/Challenge.php">Weekly Challenge</a>
			<a href="PHP/Jobs.php">Jobs</a>
			<div class="dropdown">
				<span>More</span>
				<div class="dropdown-content">
					<a href="Subpages/About.html">About Us</a><br><br>
					<a href="PHP/Contact.PHP">Contact Us</a><br><br>
					<a href="PHP/User.php">Profile</a><br><br>
				</div>
			</div>
			<a></a>
			<a></a>
		</nav>
		<div class="content">
			<br>
			<h2>Club Schedule</h2><br>
			<h3>Feburary</h3><br>
			<table>
				<tr>
					<th>Sunday</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>1</td>
					<td>2</td>
					<td>3</td>
				</tr>
				<tr>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7<br><br>Weekly Meeting:<br> 4:00-5:00
					<p style="display:none">Location: Room 113<br><br>Topics: Leetcode problem reviews, job hunts, new and existing projects</p></td>
					<td>8</td>
					<td>9</td>
					<td>10</td>
				</tr>
				<tr>
					<td>11</td>
					<td>12</td>
					<td>13</td>
					<td>14<br><br>Weekly Meeting:<br> 4:00-5:00
					<p style="display:none">Location: Room 113<br><br>Topics: Leetcode problem reviews, job hunts, new and existing projects</p></td>
					<td>15</td>
					<td>16</td>
					<td>17</td>
				</tr>
				<tr>
					<td>18</td>
					<td>19</td>
					<td>20</td>
					<td>21<br><br>Weekly Meeting:<br> 4:00-5:00
					<p style="display:none">Location: Room 113<br><br>Topics: Leetcode problem reviews, job hunts, new and existing projects</p></td>
					<td>22</td>
					<td>23</td>
					<td>24</td>
				</tr>
				<tr>
					<td>25</td>
					<td>26</td>
					<td>27</td>
					<td>28<br><br>Weekly Meeting:<br> 4:00-5:00
					<p style="display:none">Location: Room 113<br><br>Topics: Leetcode problem reviews, job hunts, new and existing projects</p></td>
					<td>29</td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<br><br>
		</div>
	</body>
	<footer>
		<p id="footerText">Created in partnership with Central Washington University, Des Moines</p><br>
		<div id="footerNav">
			<a href="Index.php">Home</a>
			<a href="PHP/Project.php">Projects</a>
			<a href="PHP/Networking.php">Networking</a>
			<a href="PHP/Challenge.php">Weekly Challenge</a>
			<a href="PHP/Jobs.php">Jobs</a>
			<a href="Subpages/About.html">About Us</a>
			<a href="PHP/Contact.php">Contact Us</a>
			<a href="PHP/User.php">Profile</a>
		</div>
	</footer>
</html>