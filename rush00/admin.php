<?PHP include ("header.php"); 




?>

	<BODY>
		<div id="wrapping">
		<h1>CONNEXION ADMINISTRATEUR</h1> 
		<?php
		if (!empty($_POST["login"]) && !empty($_POST["passwd"]) && isset($_POST['submit']) && $_POST["submit"] === "Soumettre")
			echo "<h2>Vous n'êtes pas administrateur</h2><br />";
		?>
		<form method="post" action="admin.php">
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