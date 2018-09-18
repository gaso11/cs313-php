<html>
<head>
	<link rel="stylesheet" href="homeStyle.css">
	<title>
		Evan's Homepage
	</title>
</head>
<body>
	<h1>Evan's Homepage</h1>

	<ul>
  		<li><a class="active" href="home.php">Home</a></li>
  		<li><a href="assignments.html">Assignments</a></li>
	</ul>
	<br>

	<div class="centered">
		<button class="button shadows centered"><a href="assignments.html">Assignments</a></button>
	</div>


	<!--Push to bottom of page-->
	<br>
	<br>
	<br>
	<br>
	<!-- PHP doing "something" -->
	<?php

  		echo "Server time: " . date("D M d, Y G:i a");

	?>
</body>
</html>