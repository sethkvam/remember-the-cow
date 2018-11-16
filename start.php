<?php
/*
	This file is the start page for a to-do list website.
*/
session_start();
include("common.php");
if (isset($_SESSION["name"])) {
	header("Location: todolist.php");
}

heading(); ?>

		<div id="main">
			<?php
			if (isset($_SESSION["error"])){
				$error = $_SESSION["error"];
				errors($error);
				unset($_SESSION["error"]);
			}
			?>
			<p>
				The best way to manage your tasks. <br />
				Never forget the cow (or anything else) again!
			</p>

			<p>
				Log in now to manage your to-do list. <br />
				If you do not have an account, one will be created for you.
			</p>

			<form id="loginform" action="login.php" method="post">
				<div><input name="name" type="text" size="8" autofocus="autofocus" placeholder="User Name" /></div>
				<div><input name="password" type="password" size="8" placeholder="Password" /></div>
				<div><input type="submit" value="Log in" /></div>
			</form>

				<?php
				if (isset($_COOKIE["timestamp"])) {
					$stamp = $_COOKIE["timestamp"];
					?>
					<p>
						<em>(last login from this computer was <?= $stamp ?>)</em>
					</p>
					<?php
				}
				?>
		</div>
		<?php footer(); ?>
	</body>
</html>
