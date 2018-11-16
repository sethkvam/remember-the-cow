<?php
/*
	This file will log the user out of his to-do list and
	back to the start screen.
*/
session_start();
if(isset($_SESSION["name"])) {
	session_destroy();
}
header("Location: start.php");

?>