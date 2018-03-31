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

			//Table colors-products
			$create_colors_products = "CREATE TABLE colors_products (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			product_id VARCHAR(30) NOT NULL,
			color_id VARCHAR(30) NOT NULL
			)";
			if (mysqli_query($conn, $create_colors_products))
				echo "Colors-products : OK <br />";

			//Table produits
			$create_products = "CREATE TABLE products (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			name VARCHAR(255) NOT NULL,
			price INT NOT NULL,
			img TEXT NULL,
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

			mysqli_query($mysqli, "ALTER TABLE cats_products ADD CONSTRAINT colors_products_fk0 FOREIGN KEY (product_id) REFERENCES products(id)");
			mysqli_query($mysqli, "ALTER TABLE cats_products ADD CONSTRAINT colors_products_fk1 FOREIGN KEY (color_id) REFERENCES colors(id)");
			mysqli_query($mysqli, "ALTER TABLE colors_products ADD CONSTRAINT cats_products_fk0 FOREIGN KEY (product_id) REFERENCES products(id)");
			mysqli_query($mysqli, "ALTER TABLE colors_products ADD CONSTRAINT cats_products_fk1 FOREIGN KEY (cat_id) REFERENCES cats(id)");
			mysqli_query($mysqli, "ALTER TABLE cart ADD CONSTRAINT cart_fk0 FOREIGN KEY (user_id) REFERENCES users(id)");
			mysqli_query($mysqli, "ALTER TABLE cart_product ADD CONSTRAINT cart_product_fk0 FOREIGN KEY (order_id) REFERENCES cart(id)");
			mysqli_query($mysqli, "ALTER TABLE cart_product ADD CONSTRAINT cart_product_fk1 FOREIGN KEY (product_id) REFERENCES products(id)");

			if (mysqli_multi_query($conn, "INSERT INTO products (name, price)
				VALUES ('T-shirt manches courtes', '10'),
				('T-shirt manches longues', '15'),
				('Pantalon', '20'),
				('Chaussettes', '5');"))
				echo "Products - filled <br \>";

			if (mysqli_multi_query($conn, "INSERT INTO users (login, passwd, firstname, lastname, email, admin)
				VALUES ('test', '" . hash('whirlpool', 'test') . "', 'John', 'Doe', 'john@example.com', '0'),
				('test2', '" . hash('whirlpool', 'test') . "', 'Mary', 'Moe', 'mary@example.com', '0'),
				('test3', '" . hash('whirlpool', 'test') . "', 'Julie', 'Dooley', 'julie@example.com', '0');"))
				echo "Users - filled <br \>";

		}
		else
			echo "Error creating table: " . $conn->error;


		mysqli_close($conn);
		?>
	</body>
</html>