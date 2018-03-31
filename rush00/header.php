<HTML>
	<HEAD>

	<TITLE>Rush00</TITLE>
	<META charset="utf-8" />
	<LINK rel="stylesheet" href="style/header.css">
	<LINK rel="stylesheet" href="style/style.css">

	</HEAD>

	<BODY>

		<HEADER>

		<NAV id="Menu_deroulant">
		<UL>
			<LI><a href="index.php">ACCUEIL</a>
			</LI>
			<LI>ARTICLES
				<UL>
					<LI><a href="categories.php">T-Shirt</a></LI>
					<LI><a href="categories.php">Pantalons</a></LI>
					<LI><a href="categories.php">Vestes</a></LI>
				</UL>
			</LI>
			<?php 
			if (empty($_SESSION["logged_on_user"]))
				echo "<LI>MON COMPTE</a>";
			else
				echo "<li>". $_SESSION["logged_on_user"]. "</a>";
			?>
				<UL>
					<LI><a href="login.php">Connexion</a></LI>
					<LI><a href="inscription.php">Inscription</a></LI>
					<LI><a href="login.php">Desinscription</a></LI>
					<LI><a href="admin.php">Administrateur</a></LI>
				</UL>
			</LI>
			<LI>MON PANIER
				<UL>
					<LI><a href="panier.php">Consulter</a></LI>
					<LI>Sauvegarder</LI>
					<LI>Vider</LI>
				</UL>
			</LI>
		</UL>
	</NAV>
	
	</HEADER>

	</BODY>

</HTML>