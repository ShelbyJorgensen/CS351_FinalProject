<?php
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		echo "test <br><br><br>";
		$projectNum = $_GET["number"];
		echo $projectNum . "<br><br>";
	}
?>
<DOCTYPE! HTML>
<html>
	<head>
		<script src="../JavaScript/projectScript.js" defer></script>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	</head>
	<body>
		<button name="join" class="discussion" id="join">Join</button>
		<p style="display: none;" id="projectNum">1</p>
	</body>
</html>