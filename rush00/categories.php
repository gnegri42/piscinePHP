<?PHP
	session_start();
	include ("header.php");

	if (isset($_POST["add"]) && is_numeric($_POST["add"]) && isset($_POST["quantity"]) && is_numeric($_POST["quantity"]))
	{
        if (isset($_SESSION["produits"]))
        {
			$index = array_search($_POST["add"], array_column($_SESSION["produits"], "id"));
            if ($index === false)
                $_SESSION["produits"][] = array("id" => $_POST["add"], "name" => $_POST["name"], "quantity" => $_POST["quantity"], "price" => $_POST["price"], "total" => ($_POST["quantity"] * $_POST["price"]));
            else
                $_SESSION["produits"][$index] = array("id" => $_POST["add"], "name" => $_POST["name"], "quantity" => $_POST["quantity"], "price" => $_POST["price"], "total" => ($_POST["quantity"] * $_POST["price"]));
        }
        else
        {
			$_SESSION["produits"][] = array("id" => $_POST["add"], "name" => $_POST["name"], "quantity" => $_POST["quantity"], "price" => $_POST["price"], "total" => ($_POST["quantity"] * $_POST["price"]));
        }
        //print_r($_SESSION["produits"]);
	}
?>
<HTML>
	<BODY>
		<div id="wrapping">
		<h1>Catégories</h1>
		<!-- MENU DES COULEURS -->
		<div class="colors_nav">
			<ul>
				<?php
				$conn = mysqli_connect("localhost", "root", "admin1");
				if (!$conn) 
					die("Connection failed: " . mysqli_connect_error());
				mysqli_select_db($conn, "eshop");
				$req = "SELECT name FROM `colors`";
				//$result = mysqli_query($conn, $req);
				$result = mysqli_query($conn, $req);
				if (mysqli_num_rows($result) > 0) 
				{
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<a href='categories.php?color=$row[name]'><LI>$row[name]</LI></a>";
					}
				}
				?>
			</ul>
		</div>
		<SECTION class="grid">

		<!-- AFFICHAGE DES CATEGORIES EN FONCTION DES COULEURS/CATEGORIES -->
		<?php
		if (!empty($_GET["color"]))
		{
			$conn = mysqli_connect("localhost", "root", "admin1");
			if (!$conn) 
				die("Connection failed: " . mysqli_connect_error());
			mysqli_select_db($conn, "eshop");
			$color = mysqli_real_escape_string($conn, $_GET["color"]);
			$req = "SELECT products.name, products.id, price, img FROM products INNER JOIN colors ON products.color_id = colors.id WHERE colors.name = '$color'";
			//$result = mysqli_query($conn, $req);
			$result = mysqli_query($conn, $req);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result))
				{
					 echo <<<EOL
							<DIV class="product">
								<DIV class="product_info">
									<IMG class="product_image" src="$row[img]" alt="$row[name]" />
									<H1 class="product_name">$row[name]</H1>
									<SPAN class="product__price highlight">$row[price]€</SPAN>
									<form method="post" class="form1">
										<input type="hidden" name="name" value="$row[name]" />
										<input type="hidden" name="img" value="$row[img]" />
										<input type="hidden" name="price" value="$row[price]" />
										<input type="number" name="quantity" min="1" value="1">
										<button type="submit" name="add" value="$row[id]" class="buy"/>Commander</button>
									</form>
								</DIV>
							</DIV>
EOL;
					}
				}
				else
					echo "error";
			}
			if (!empty($_GET["cat"]))
			{
				$conn = mysqli_connect("localhost", "root", "admin1");
				if (!$conn) 
					die("Connection failed: " . mysqli_connect_error());
				mysqli_select_db($conn, "eshop");
				$cat = mysqli_real_escape_string($conn, $_GET["cat"]);
				$req = ("SELECT product_id FROM cats_products WHERE cat_id = (SELECT cats.id FROM cats WHERE cats.name = '$cat')");
				$result = mysqli_query($conn, $req);
				 echo '<div class="shopping-list">';
			    if (mysqli_num_rows($result) > 0)
			    {
			        while($categories = mysqli_fetch_assoc($result))
			        {

			        $req = "SELECT * FROM `products` WHERE products.id  = '$categories[product_id]'";
			        $ret = mysqli_query($conn, $req);
			            if (mysqli_num_rows($ret) > 0)
			            {
			                while($row = mysqli_fetch_assoc($ret))
			                {

			                    echo <<<EOL
			                    <DIV class="product">
									<DIV class="product_info">
										<IMG class="product_image" src="$row[img]" alt="$row[name]" />
										<H1 class="product_name">$row[name]</H1>
										<SPAN class="product__price highlight">$row[price]€</SPAN>
										<form method="post" class="form1">
											<input type="hidden" name="name" value="$row[name]" />
											<input type="hidden" name="img" value="$row[img]" />
											<input type="hidden" name="price" value="$row[price]" />
											<input type="number" name="quantity" min="1" value="1">
											<button type="submit" name="add" value="$row[id]" class="buy"/>Commander</button>
										</form>
									</DIV>
								</DIV>
EOL;
		                }  
		            }
		        }
		    }
		}
	    echo '</div>';
		?>









<!--
		<DIV class="product">
			<DIV class="product_info">
				<DIV class="quantity">
				 	<BUTTON class="plus" type="button" name="button" onclick="my_function()">
				 		<DIV id="quantity">
				 			<INPUT type="button" id="moins" value="-" onclick="minus()">
				 			<INPUT type="text" id="count" size="10" value="1">
				 			<INPUT type="button" id="plus" value="+" onclick="plus()">
				 		</DIV>
				 		<SCRIPT>
				 			var count = 1;
				 			var nb = document.getElementById("count");
				 			function plus()
				 			{
				 				count++;
				 				nb.value = count;
				 			}
				 			function minus()
				 			{
				 				if (count > 0) 
				 				{
				 					count--;
				 					nb.value = count;
				 				}  
				 			}
				 		</SCRIPT>
				 	</BUTTON>
				 </DIV>
				<IMG class="product_image" src="http://www.stihl.fr/p/images/content_zoom_480x320/fr-fr/fr-stihl-veste-de-pluie-600x600_rdax_85.jpg" alt="Product_1" />
				<H1 class="product_name">Vetement anti-flamme</H1>
				<SPAN class="product_color">COULEUR : orange</SPAN>
				<SPAN class="product__price highlight">51€</SPAN>
				<BUTTON class="buy">
					<SPAN class="action_quantite">Ajouter au panier</SPAN>
				</BUTTON>
			</DIV>
		</DIV>
	-->
	</SECTION>
	</div>

	</BODY>
</HTML>