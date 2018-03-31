<?PHP
	session_start();

	if ($_POST["login"] !== "" && $_POST["passwd"] !== "" && $_POST["submit"] === "OK")
	{
		$file = "/private/passwd";
		if (!file_exists ("/private"))
			mkdir("/private");
		if (!file_exists($file))
			file_put_contents($file, NULL);
		$data = file_get_contents($file);
		$data = unserialize($data);
		if ($data)
		{
			foreach ($data as $elem => $value)
			{
				if ($value["login"] == $_POST["login"])
				{
					echo "ERROR\n";
					exit();
				}
			}
		}
		$user["login"] = $_POST["login"];
		$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
		$data[] = $user;
		file_put_contents($file, serialize($data));
		echo "Votre compte a bien été créé.\n";
	}
?>
<HTML>

	<?PHP include ("header.php"); ?>

	<BODY>

		<p>INSCRIPTION</p>

		<form method="post"=>

			<fieldset>

				<legend>Coordonnées</legend><br />

				<label for="nom">Nom</label>
				<input type="text" name="nom" id="nom" />

				<label for="prenom">Prénom</label>
				<input type="text" name="prenom" id="prenom" />

				<label for="date_de_naissance">Date de naissance</label>
				<input type="date" name="date_de_naissance" id="date_de_naissance">

				<label for="tel">Numero de téléphone</label>
				<input type="text" name="tel" id="tel" />

				<label for="email">Adresse e-mail</label>
				<input type="email" name="email" id="email" />

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

	</BODY>


</HTML>
