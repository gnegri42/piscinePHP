<?PHP
session_start();
include ("header.php");

function check_error_form_change()
{
	$error = TRUE;
	if (preg_match("/^.+@.+\..+$/", $_POST['email']) == FALSE) {
		echo "L'adresse email n'est pas valide.<br />";
		$error = FALSE;
	}
	if (preg_match("/^[0-9]+\s+.+\s+.+\s?$/", $_POST['adress']) == FALSE) {
		echo "L'adresse n'est pas valide.<br />";
		$error = FALSE;
	}
	if (preg_match("/^[0-9]{5}$/", $_POST['postal_code']) == FALSE) {
		echo "Le code postal n'est pas valide.<br />";
		$error = FALSE;
	}
	if (preg_match("/^\+?[0-9]+$/", $_POST['tel']) == FALSE) {
		echo "Le numéro de téléphone n'est pas valide.<br />";
		$error = FALSE;
	}
	return ($error);
}

function check_login($login, $conn)
{
	$req = "SELECT login FROM users WHERE login='$login'";
	$result = mysqli_query($conn, $req);
	if (mysqli_num_rows($result) > 0)
		return (true);
	else
		return (false);
}

if (empty($_SESSION["logged_on_user"]) && isset($_POST['submit']) && $_POST['submit'] === "Soumettre" && check_error_form_change() === TRUE)
{
	$conn = mysqli_connect("localhost", "root", "admin1");
	if (!$conn) 
		die("Connection failed: " . mysqli_connect_error());
	mysqli_select_db($conn, "eshop");
	$login = mysqli_real_escape_string($conn, $_POST['login']);
	$passwd = hash("whirlpool", mysqli_real_escape_string($conn, $_POST['passwd']));
	$firstname = mysqli_real_escape_string($conn, $_POST['nom']);
	$lastname = mysqli_real_escape_string($conn, $_POST['prenom']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$adress = mysqli_real_escape_string($conn, $_POST['adress']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
	$tel = mysqli_real_escape_string($conn, $_POST['tel']);
	if (check_login($login, $conn) == false)
	{
		$req = "INSERT INTO users (login, passwd, firstname, lastname, email, adress, city, postal_code, tel)
		VALUES ('$login', '$passwd', '$firstname', '$lastname', '$email', '$adress', '$city', '$postal_code', '$tel')";
		mysqli_query($conn, $req);
		header("Location: index.php");
		echo "<h2>Votre compte a été Créé!</h2>";
	}
	else
		echo "<h2>Ce login existe déjà !</h2>";
}

?>
<?php
if (empty($_SESSION["logged_on_user"]))
{
echo <<<EOL
<HTML>
	<?PHP  ?>
	<BODY>
		<div id="wrapping">

		<h1>INSCRIPTION</h1>
		<form method="post" action="inscription.php">
			<fieldset>
				<legend>Coordonnées</legend><br />

				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" />
				<br />

				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" id="prenom" />
				<br />

				<label for="tel">Numero de téléphone</label>
				<input type="text" name="tel" id="tel" />
				<br />

				<label for="email">Adresse e-mail</label>
				<input type="email" name="email" id="email" />
				<br />

				<label for="adress">Adresse</label>
				<input type="text" name="adress" id="adress" />
				<br />

				<label for="city">Ville</label>
				<input type="text" name="city" id="city" />
				<br />

				<label for="postal_code">Code postal</label>
				<input type="text" name="postal_code" id="postal_code" />
				<br />
			</fieldset>
			<fieldset>
				<legend>Identifiants de connexion</legend><br />
				Login: <input type="text" name="login" value="" />
				<br />
				Mot de passe: <input type="password" name="passwd" value="" />
				<br/>
			</fieldset>
			<input type="submit" name="submit" value="Soumettre" />
		</form>
		</div>
	</BODY>
</HTML>
EOL;
}
else
{
	echo <<<EOL
	<!DOCTYPE html>
	<html>
		<body>
		<div id="wrapping">
			<h1>Vous êtes déjà inscrits !</h1>
			<a href="index.php" title="accueil">Retour à la page d'accueil</a><br />
		</div>
		</body>
	</html>
EOL;
}
?>
