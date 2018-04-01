<?PHP
session_start();
include ("header.php");
include ("query_db.php");

function auth($login, $passwd)
{
	$conn = mysqli_connect("localhost", "root", "admin1");
	if (!$conn) 
		die("Connection failed: " . mysqli_connect_error());
	mysqli_select_db($conn, "eshop");
	$login = mysqli_real_escape_string($conn, $login);
	$passwd = mysqli_real_escape_string($conn, $passwd);
	$log = "SELECT login FROM users WHERE login = '$login'";
	$pass = "SELECT passwd FROM users WHERE passwd = '$passwd'";
	$log = mysqli_query($conn, $log);
	$pass = mysqli_query($conn, $pass);
	if ($log->num_rows > 0 && $pass->num_rows > 0)
	{
		mysqli_free_result($log);
		mysqli_free_result($pass);
		return (TRUE);
	}
	else
		echo "Ce compte n'existe pas.";
	mysqli_free_result($log);
	mysqli_free_result($pass);
	return (FALSE);
}

if (!empty($_POST["login"]) && !empty($_POST["passwd"]) && isset($_POST['submit']) && $_POST["submit"] === "OK")
{
	if (auth($_POST["login"], hash("whirlpool", $_POST["passwd"])))
	{
		$_SESSION["logged_on_user"] = $_POST["login"];
		header("Location: index.php");
	}
}
?>
<?php
if (empty($_SESSION["logged_on_user"]))
{
	echo <<<EOL
	<!DOCTYPE html>
	<html>
		<body>
		<div id="wrapping">

			<h1>S'identifier !</h1>
			<form method="post" action="login.php">
				Identifiant: <input type="text" name="login" value="" />
				<br />
				Mot de passe: <input type="password" name="passwd" value="" />
				<br/>
				<input type="submit" name="submit" value="OK" />
			</form>
			<a href="inscription.php" title="Créer un compte">S'inscrire</a><br />
		</div>
		</body>
	</html>
EOL;
}
else
{
	echo <<<EOL
	<!DOCTYPE html>
	<html>
		<body>
		<div id="wrapping">
			<h1>Vous êtes déjà authentifiés !</h1>
			<a href="delog.php" title="Se déconnecter">Se déconnecter</a><br />
			<a href="remove.php" title="Supprimer son compte">Supprimer le compte</a>
		</div>
		</body>
	</html>
EOL;
}
