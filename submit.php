<?php
/*
	This file handles adding and deleting contents of the todo list.
*/
session_start();
if(!isset($_SESSION["name"])) {
	header("Location: start.php");
	die();
}
# false parameters
if (!isset($_POST["action"])) {
	die();
}

# name, file, item parameter
$name = $_SESSION["name"];
$file = "todo_$name.txt";

# adds item to todo list
if ($_POST["action"] == "add") {
	if(!isset($_POST["item"])) {
		die();
	}
	$item = $_POST["item"];
	if($item == "" || preg_match("/\s+/")) {
		die();
	}
	file_put_contents($file, "$item\n", FILE_APPEND);
}

# deletes item from list
if ($_POST["action"] == "delete") {
	if(!isset($_POST["index"])) {
		die("Sorry bra4555555h, not today");
	}
	# existing list
	$file_contents = file($file);
	$index = $_POST["index"];

	# removes index and rewrites list to file
	unset($file_contents[$index]);
	file_put_contents($file, $file_contents);
}
header("Location: todolist.php");
?>