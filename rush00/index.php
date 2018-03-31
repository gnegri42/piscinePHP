<?PHP
	session_start();
	include("base/cats.php");
?>
<HTML>

	<?PHP include ("header.php"); ?>

	<BODY>

		<p> Page d'accueil</p>
		<?php 
		cat_get_all(); 
		?>


	</BODY>

</HTML>
