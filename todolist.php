<?php
/*
	This file displays the users to-do list to him, with options
	to add more or delete existing items.
*/
include("common.php");

session_start();
# denies user if they have not logged in
if(!isset($_SESSION["name"])) {
	header("Location: start.php");
	die();
}

$name = $_SESSION["name"];

heading(); ?>

		<div id="main">
			<h2><?= $name ?>'s To-Do List</h2>
			
			<ul id="todolist">
				<?php 
				if(file_exists("todo_$name.txt")) {
					$file = file("todo_$name.txt", FILE_IGNORE_NEW_LINES);
					$i = 0;
					foreach ($file as $item) {
						list_item(htmlspecialchars($item), $i);
						$i++;
					}
				}
				?>
				
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="add" />
						<input name="item" type="text" size="25" autofocus="autofocus" />
						<input type="submit" value="Add" />
					</form>
				</li>
			</ul>

			<div>
				<a href="logout.php"><strong>Log Out</strong></a>
				<?php
				$time = $_COOKIE["timestamp"];
				?>
				<em>(logged in since <?= $time ?>)</em>
			</div>
		</div>
		<?php footer(); ?>
	</body>
</html>

<?php

# This method will insert a new item in the to-do list with the
# specified parameter as the name
function list_item($subject, $i) {
	?>
	<li>
		<form action="submit.php" method="post">
			<input type="hidden" name="action" value="delete" />
			<input type="hidden" name="index" value="<?= $i ?>" />
			<input type="submit" value="Delete" />
		</form>
		<?= $subject ?>
	</li>
	<?php
}
?>
