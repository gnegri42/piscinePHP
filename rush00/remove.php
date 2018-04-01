<?php
session_start();
include ("header.php");
include ("query_db.php");
if (isset($_POST['submit']) && $_POST["submit"] === "Oui!")
{
	$login = $_SESSION["logged_on_user"];
	query_db("DELETE FROM users WHERE login = '$login'");
	$_SESSION["logged_on_user"] = NULL;
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
	<body>
		<div id="wrapping">
		<h1>Suppression du compte!!</h1>
		<?php if ($_SESSION["logged_on_user"] === NULL)
				echo "Vous n'êtes pas connecté, vous ne pouvez pas supprimer de compte!";
			else
				echo '<form method="post" action="remove.php">
			Voulez-vous vraiment supprimer votre compte?
			<input type="submit" name="submit" value="Oui!" />
		</form> ';?>
		</div>
	</body>
</html>