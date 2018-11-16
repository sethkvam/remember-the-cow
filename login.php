<?php
/*
	This file handles validation and logging a user into his to-do list.
*/

# if the user is already logged in, he/she is redirected to their list.
if (isset($_SESSION["name"])) {
	header("Location: todolist.php");
	die();
}

# if the user's name and password parameters are not passed
# correctly, they are denied and returned to the start, otherwise
# they are continued through
if (!isset($_POST["name"]) || !isset($_POST["password"])) {
	header("Location: start.php");
	die("Error - access denied");
} else {
	$name = $_POST["name"];
	$password = $_POST["password"];	
}

$file_name = "users.txt";

# checks the user's name and password with the file of names and passwords
# to check if they are accruate, if so the user is directed to their list.
# If not, they are returned with an error message.
if(filesize($file_name) > 0) {
	$file = file($file_name, FILE_IGNORE_NEW_LINES);
	foreach ($file as $line) {
		$user = explode(":", $line);
		$user_name = $user[0];
		$user_password = $user[1];
		if ($user_name == $name && $user_password == $password) { # it matches
			todo_redirect($name, $password);
			die();
		} else if ($user_name == $name && $user_password != $password) { # name exists, password wrong
			session_start();
			$_SESSION["error"] = "Incorrect Password";
			header("Location: start.php");
			die();
		}
	}
}

# if the user's name is not in the file, but passes the requirements
# they are added and continued through. If requirements are not met,
# errors are displayed and they are returned to the start
if (preg_match("/\$name/", $password)) {
	header("Location: start.php");
	die();
} else if (preg_match("/^[a-z0-9]{3,8}$/", $name) && preg_match("/^\d.{4,10}\W$/", $password)) { # matches
	file_put_contents($file_name, "$name:$password\n", FILE_APPEND);
	todo_redirect($name, $password);
	die();
} else if (!preg_match("/^[a-z0-9]{3,8}$/", $name)) { # incorrect name
	session_start();
	$_SESSION["error"] = "Illegal name";
	header("Location: start.php");
	die();
} else if (!preg_match("/^\d.{4,10}\W$/", $password)) { # incorrect password
	session_start();
	$_SESSION["error"] = "Illegal password";
	header("Location: start.php");
	die();
}

# this function accepts the name and password as parameters,
# passes the timestamp and name and password on to the list
function todo_redirect($name, $password) {
	session_start();
	$_SESSION["name"] = $name;
	$_SESSION["password"] = $password;
	$date = date("D y M d, g:i:s a");
	$expire = time() + 60*60*24*7;
	setcookie("timestamp", $date, $expire);
	header("Location: todolist.php");
}
?>