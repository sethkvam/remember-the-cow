<?php
/*
	This file handles redundant code used throughout the to-do website.
*/

# displays the header. Common across all pages.
function heading() {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Remember the Cow</title>
		<link href="https://webster.cs.washington.edu/css/cow-provided.css" type="text/css" rel="stylesheet" />
		<link href="cow.css" type="text/css" rel="stylesheet" />
		<link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico" rel="shortcut icon" />
		<script src="https://webster.cs.washington.edu/js/todolist/provided.js" type="text/javascript"></script>
	</head>

	<body>
	
	<div class="headfoot" id="head">
		<h1>
			<img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo" />
			Remember<br />the Cow
		</h1>
	</div>
	<?php
}

# displays the footer. Common across all pages.
function footer() {
	?>
	<div class="headfoot" id="foot">
		<p>
			"Remember The Cow is nice, but it's a total copy of another site." - PCWorld<br />
			All pages and content &copy; Copyright CowPie Inc.
		</p>

		<div id="w3c">
			<a href="https://webster.cs.washington.edu/validate-html.php">
				<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
			<a href="https://webster.cs.washington.edu/validate-css.php">
				<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</div>
	<?php
}

# takes the error as a parameter and displays it to the user.
function errors($error) {
	?>
	<div id="error"><?= $error ?></div>
	<?php
}
?>
