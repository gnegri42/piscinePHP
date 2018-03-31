<?php
	require_once('query_db.php');

	function cart_create(int $id)
	{
		$conn = connect_db();
		$req = "INSERT INTO cart (user_id) VALUES ('$id')";
		$req = mysqli_query($conn, $req);
		return ($req);
	}

	function cart_get_by_date(string $date)
	{
		$conn = connect_db();
		$date = mysqli_real_escape_string($date);
		$req = "SELECT * FROM cart WHERE date_cart = '$date'";
		$req = mysqli_query($conn, $req);
		$ret = mysqli_fetch_assoc($req);
		return $ret;
	}

	function cart_get_by_id(int $pid)
	{
		$conn = connect_db();
		$req = "SELECT * FROM cart WHERE user_id = '$pid'";
		$req = mysqli_query($conn, $req);
		if ($req)
			return mysqli_fetch_assoc($req);
		return NULL;
	}

	function cart_get_by_user_id(int $people_id)
	{
		$conn = connect_db();
		$req = "SELECT * FROM cart INNER JOIN cart_product AS op ON op.order_id = order.id
									 INNER JOIN products ON product.id = op.product_id WHERE user_id = '$user_id'";
		$req = mysqli_query($conn, $req);
		if ($req)
			return mysqli_fetch_all($req, MYSQLI_ASSOC);
		return null;
	}

	function cart_delete_byp_user_id(int $people_id)
	{
		$conn = connect_db();
		$req = "DELETE FROM cart WHERE user_id = '$user_id'";
		$req = mysqli_query($conn, $req);
		return $req;
	}

	function cart_delete(int $id)
	{
		$conn = connect_db();
		$req = "DELETE FROM cart WHERE id = '$id'";
		$req = mysqli_query($conn, $req);
		return $req;
	}
?>