<HTML>
	<HEAD>

	<TITLE>Rush00</TITLE>
	<META charset="utf-8" />
	<LINK rel="stylesheet" href="style/header.css">
	<LINK rel="stylesheet" href="style/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</HEAD>

	<BODY>

		<HEADER>

		<NAV id="Menu_deroulant">
		<UL>
			<LI><a href="index.php">ACCUEIL</a>
			</LI>
			<LI>ARTICLES
				<UL>
					<?php
					$conn = mysqli_connect("localhost", "root", "admin1");
					if (!$conn) 
						die("Connection failed: " . mysqli_connect_error());
					mysqli_select_db($conn, "eshop");
					$req = "SELECT name FROM `cats`";
					//$result = mysqli_query($conn, $req);
					$result = mysqli_query($conn, $req);
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result))
						{
							echo "<LI><a href='categories.php?cat=$row[name]'>$row[name]</a></LI>";
						}
					}
					else
					{
						echo "
						<LI><a href='categories.php'>T-Shirt</a></LI>
						<LI><a href='categories.php'>Pantalons</a></LI>
						<LI><a href='categories.php'>Vestes</a></LI>
						";
					}
					?>
				</UL>
			</LI>
			<?php 
			if (empty($_SESSION["logged_on_user"]))
				echo "<LI>MON COMPTE</a>";
			else
				echo "<li>". $_SESSION["logged_on_user"]. "</a>";
			?>
				<UL>
					<?php 
					if (empty($_SESSION["logged_on_user"]))
						echo "<LI><a href='login.php'>Connexion</a></LI>";
					else
						echo "<li><a href='login.php'>Gerer compte</a>";
					?>
					<LI><a href="inscription.php">Inscription</a></LI>
					<LI><a href="admin.php">Administrateur</a></LI>
				</UL>
			</LI>
			<LI>MON PANIER
				<UL>
					<LI><a href="panier.php">Consulter</a></LI>
				</UL>
			</LI>
		</UL>
	</NAV>
	
	</HEADER>

	<FOOTER>
		<p id="copyright">&copy; 2018</p>
	</FOOTER>
	</BODY>

</HTML>