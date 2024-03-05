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
	
	if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		$username = $_COOKIE['username'];
		$sql = "DELETE FROM users WHERE username = '$username';";
		setcookie("username", "", time() - 36000, '/');
		$conn->query($sql);
	}
?>