<?PHP
session_start();
include ("header.php");
include ("query_db.php");

function auth($login, $passwd)
{
	$log = query_db("SELECT login FROM users WHERE login = '$login'");
	$pass = query_db("SELECT passwd FROM users WHERE passwd = '$passwd'");
	if ($log->num_rows > 0 && $pass->num_rows > 0)
	{
		echo "OK";
		mysqli_free_result($log);
		mysqli_free_result($pass);
		return (TRUE);
	}
	else
		echo "false";
	mysqli_free_result($log);
	mysqli_free_result($pass);
	return (FALSE);
}

if (!empty($_POST["login"]) && !empty($_POST["passwd"]) && $_POST["submit"] === "OK")
{
	if (auth($_POST["login"], hash("whirlpool", $_POST["passwd"])))
	{
		$_SESSION["logged_on_user"] = $_POST["login"];
		echo "OK\n";
	}
}
?>

<!DOCTYPE html>
<html>
	<body>
		<h1>S'identifier !</h1>
		<form method="post" action="login.php">
			Identifiant: <input type="text" name="login" value="" />
			<br />
			Mot de passe: <input type="password" name="passwd" value="" />
			<br/>
			<input type="submit" name="submit" value="OK" />
		</form>
		<a href="inscription.php" title="Créer un compte">S'inscrire</a><br />
		<a href="delog.php" title="Se déconnecter">Se déconnecter</a><br />
		<a href="remove.php" title="Supprimer son compte">Supprimer le compte</a>
	</body>
</html>
