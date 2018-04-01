<?PHP
	session_start();
?>
<HTML>
	<?PHP include ("header.php"); ?>
	<BODY>
		<div id="wrapping">
			<h1 id="welcome">Bienvenue sur le site!</h1>
			<h2 class="titre_small">Venez découvrir un monde rempli de vêtements !</h2>
			<div id="conteneur">
				<div class="element"><img src="https://images.unsplash.com/photo-1513521712264-512ceb91a940?ixlib=rb-0.3.5&s=10cfc807218fc50bb512f7a4ae23f4f4&auto=format&fit=crop&w=934&q=80" alt="cloth1"></div>
				<div class="element"><img src="https://images.unsplash.com/photo-1453486030486-0a5ffcd82cd9?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=052b30525366ca5a40960f17efe735d7&auto=format&fit=crop&w=913&q=80" alt="cloth2"></div>
			</div>
			<a href="categories.php?cat=Vestes" id="button_accueil">Venez voir nos vestes</a>
		</div>
	</BODY>

</HTML>
