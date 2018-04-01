<?PHP
	session_start();
?>
<HTML>

	<?PHP 
	include ("header.php");

	if (isset($_POST['submit']) && $_POST['submit'] === "Commander")
	{
		$conn = mysqli_connect("localhost", "root", "admin1");
		if (!$conn) 
			die("Connection failed: " . mysqli_connect_error());
		mysqli_select_db($conn, "eshop");

		$total_cart = mysqli_real_escape_string($conn, $_SESSION['total']);
		$login = mysqli_real_escape_string($conn, $_SESSION['logged_on_user']);
		$req_login = "SELECT id FROM users WHERE login = '$login'";
		$result = mysqli_query($conn, $req_login);
		if (mysqli_num_rows($result) == 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$user_id = $row["id"];
			}
		}
		if (isset($_SESSION["produits"]) && $_SESSION["produits"] != NULL)
		{
        	$req = "INSERT INTO cart (user_id, total) VALUES ($user_id, $total_cart)";
			$result = mysqli_query($conn, $req);
    		foreach($_SESSION["produits"] as $prod)
    		{
            	$req_cart = "INSERT INTO cart_product (order_id, product_id, qty) VALUES ((SELECT cart.id FROM cart WHERE (user_id = $user_id ) limit 1), $prod[id], $prod[quantity])";
				$result = mysqli_query($conn, $req_cart);
        	}
        }
        $_SESSION["produits"] = NULL;
    }

	if (!empty($_SESSION["logged_on_user"]))
	{
	?>

	<LINK rel="stylesheet" href="style/panier.css">

	<BODY>
		<div id="wrapping">

		<H1>MON PANIER</h1>
		<a href="empty.php" title="Empty cart">Vider le panier</a><br />
		<TABLE class="panier" >

			<TR class="produits">
				<TH class="en-tête">ID</TH>
				<TH class="en-tête">Nom</TH>
				<TH class="en-tête">Quantité</TH>
				<TH class="en-tête">Prix</TH>
				<TH class="en-tête">Total</TH>
			</TR>

			<TR class="panier" >
				<?PHP 
				$_SESSION["total"] = 0;
				if ($_SESSION["produits"] !== NULL)
					{
						foreach ($_SESSION["produits"] as $produit)
						{
							$i = 0;
							echo "<TR class='panier'>";
							foreach ($produit as $truc) {
						echo "<TD class='ligne'>" . $truc ."</TD>";
						if ($i == 4)
							$_SESSION["total"] += $truc;
						$i++;
						}
							echo "</TR>";
						}}
				?>
			</TR>

			<TR class="panier">
				<TD class="total">TOTAL :</TD>
				<TD class="total"></TD>
				<TD class="total"></TD>
				<TD class="total"></TD>
				<TD class="total"><?PHP echo $_SESSION["total"]."€" ?></TD>
			</TR>
 		</TABLE>

 		</BR>
 		<form method="post" class="form1">
	 		<BUTTON id="button" class="total">
	 			<input type="submit" class="action_quantite" name="submit" value="Commander" />
	 		</BUTTON>
		</form>
 		</div>
	</BODY>
	<?php
	}
	else
	{
	echo <<<EOL
	<!DOCTYPE html>
	<html>
		<body>
		<div id="wrapping">
			<h1>Vous n'êtes pas connectés!</h1>
			<p>Pour valider votre panier vous devez d'abord <a href="login.php" title="login">vous connecter</a></p><br />
		</div>
		</body>
	</html>
EOL;
	}
?>
</HTML>
