<!DOCTYPE html>
<html>
   <head>
      <title>Connecting MySQLi Server</title>
   </head>
   
   <body>
		<?php
		// Create connection
		$conn = mysqli_connect("localhost", "root", "admin1");

		// Check connection
		if (!$conn) 
		    die("Connection failed: " . mysqli_connect_error());
		echo "<h1>Connected successfully</h1><br />";
		// Create database
		mysqli_query($conn, "DROP DATABASE IF EXISTS eshop");
		$sql = "CREATE DATABASE eshop";
		if (mysqli_query($conn, $sql)) 
		{
			echo "<h2>Database created successfully</h2><br />";
			mysqli_select_db($conn, "eshop");

			$create_users = "CREATE TABLE users (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			login VARCHAR(30) NOT NULL UNIQUE,
			passwd VARCHAR(255) NOT NULL,
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50) NULL,
			adress VARCHAR(255) NULL,
			city VARCHAR(255),
			postal_code INT NULL,
			tel	INT(10) NULL,
			admin INT(1) DEFAULT '0',
			reg_date TIMESTAMP
			)";
			if (mysqli_query($conn, $create_users))
				echo "Users : OK <br />";

			//Table couleurs
			$create_colors = "CREATE TABLE colors (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(30) NOT NULL UNIQUE
			)";
			if (mysqli_query($conn, $create_colors))
				echo "Colors : OK <br />";

			//Table produits
			$create_products = "CREATE TABLE products (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(255) NOT NULL,
			price INT NOT NULL,
			img TEXT NULL,
			color_id VARCHAR(30) NOT NULL,
			qty	INT(5) NULL
			)";
			if (mysqli_query($conn, $create_products))
				echo "Products : OK <br />";

			//Table categories
			$create_cats = "CREATE TABLE cats (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(30) NOT NULL UNIQUE,
			img TEXT NULL
			)";
			if (mysqli_query($conn, $create_cats))
				echo "Categories : OK <br />";

			//Table liaison categories-produits
			$create_cats_products = "CREATE TABLE cats_products (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			cat_id INT(6) UNSIGNED NOT NULL,
			product_id INT(6) UNSIGNED NOT NULL
			)";
			if (mysqli_query($conn, $create_cats_products))
				echo "Lien cat-produits : OK <br />";

			//Table panier
			$create_cart = "CREATE TABLE cart (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			user_id INT(6) UNSIGNED NOT NULL,
			price INT(6) UNSIGNED NOT NULL,
			)";
			if (mysqli_query($conn, $create_cart))
				echo "Cart : OK <br />";

			//Table produit dans panier
			$create_cart_product = "CREATE TABLE cart_product (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			order_id INT(6) UNSIGNED NOT NULL,
			product_id INT(6) UNSIGNED NOT NULL,
			qty INT(6) UNSIGNED NOT NULL
			)";
			if (mysqli_query($conn, $create_cart_product))
				echo "Cart_product : OK <br />";

			mysqli_query($conn, "ALTER TABLE products ADD CONSTRAINT products_color_fk FOREIGN KEY (color_id) REFERENCES colors(id)");
			mysqli_query($conn, "ALTER TABLE colors_products ADD CONSTRAINT cats_products_fk0 FOREIGN KEY (product_id) REFERENCES products(id)");
			mysqli_query($conn, "ALTER TABLE colors_products ADD CONSTRAINT cats_products_fk1 FOREIGN KEY (cat_id) REFERENCES cats(id)");
			mysqli_query($conn, "ALTER TABLE cart ADD CONSTRAINT cart_fk0 FOREIGN KEY (user_id) REFERENCES users(id)");
			mysqli_query($conn, "ALTER TABLE cart_product ADD CONSTRAINT cart_product_fk0 FOREIGN KEY (order_id) REFERENCES cart(id)");
			mysqli_query($conn, "ALTER TABLE cart_product ADD CONSTRAINT cart_product_fk1 FOREIGN KEY (product_id) REFERENCES products(id)");

			if (mysqli_multi_query($conn, "INSERT INTO products (name, price, color_id, img)
				VALUES 
				('Veste en cuir', '900', '4', 'https://media.brandalley.com/img_rayons/1600x1600/2016/02/04/872/1954872_1.jpg'),
				('Jean', '80', '1', 'https://cdn1.size-factory.com/37860-thickbox_default/jean-bleu-indigo-grande-taille-jusqu-au-62fr-48us.jpg'),
				('Veste à capuche', '42', '4', 'https://i2.cdscdn.com/pdt2/4/3/3/1/300x300/mp06295433/rw/veste-a-capuche-homme-mode-mince-automne-veste-vet.jpg'),
				('Mini-sort', '19', '1', 'http://lp2.hm.com/hmprod?set=source[/model/2017/F00%200475274%20004%2079%202570.jpg],type[STILLLIFE_FRONT],res[s]&hmver=2&call=url[file:/product/main]'),
				('T-shirt manches courtes', '10', '2', 'http://media.intersport.fr/is/image/intersportfr/5000217AMR_Q1'),
				('T-shirt manches longues', '15', '2', 'http://www.halle-vetement.com/48-98-thickbox/t-shirt-manches-longue-rouge.jpg'),
				('T-shirt cool', '24', '1', 'https://www.limpressionniste.org/364-thickbox_default/t-shirt-bleu-antique-sapphire-clubvtt-en-coton.jpg'),
				('Pantalon', '65', '1', 'https://www.usinenouvelle.com/expo/img/pantalon-bleu-de-travail-basic-100-coton-poche-genoux-002189663-product_zoom.jpeg'),
				('Veste', '156', '3', 'https://i2.cdscdn.com/pdt2/6/2/9/1/300x300/mp01763629/rw/hee-grand-femme-blazer-vest-tailleur-jaune.jpg'),
				('Pyjama Cochon', '59', '4', 'https://www.1001deguisement.fr/127-thickbox_default/d%C3%A9guisement-cochon-homme-porc-babe.jpg')
				;"))
				echo "Products - filled <br \>";

			if (mysqli_multi_query($conn, "INSERT INTO users (login, passwd, firstname, lastname, email, admin)
				VALUES ('test', '" . hash('whirlpool', 'test') . "', 'John', 'Doe', 'john@example.com', '0'),
				('test2', '" . hash('whirlpool', 'test') . "', 'Mary', 'Moe', 'mary@example.com', '0'),
				('test3', '" . hash('whirlpool', 'test') . "', 'Julie', 'Dooley', 'julie@example.com', '0');"))
				echo "Users - filled <br \>";

			if (mysqli_multi_query($conn, "INSERT INTO cats (name)
				VALUES 
				('T-Shirt'),
				('Pantalons'),
				('Vestes');"
				))
				echo "Categories - filled <br \>";

			if (mysqli_multi_query($conn, "INSERT INTO cats_products (cat_id, product_id)
				VALUES 
				('3', '1'),
				('2', '2'),
				('3', '3'),
				('2', '4'),
				('1', '5'),
				('1', '6'),
				('1', '7'),
				('2', '8'),
				('3', '9'),
				('2', '10'),
				('3', '10');"))
				echo "Lien produit-categorie - filled <br \>";

			if (mysqli_multi_query($conn, "INSERT INTO colors (name)
				VALUES 
				('Bleu'),
				('Rouge'),
				('Jaune'), 
				('Noir');"))
				echo "Colors - filled <br \>";
		}
		else
			echo "Error creating table: " . $conn->error;
		?>
	</body>
</html>