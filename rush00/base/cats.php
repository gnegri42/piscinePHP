<?php
	include('query_db.php');

	function cat_create(string $name)
	{
		$err = NULL;
		$conn = connect_db();
		if (strlen($name) < 3 || strlen($name) > 45)
			$err[] = 'name';
		if ($err !== NULL)
			return ($err);
		$name = mysqli_real_escape_string($conn, $name);
		$req = "INSERT INTO cats (name) VALUES ('$name')";
		$req = mysqli_query($conn, $req);
		return ($req);
	}

	function cat_update(string $oldname, string $newname)
	{
		$err = NULL;
		$conn = connect_db();
		if (strlen($newname) < 3 || strlen($newname) > 45)
			$err[] = 'name';
		if ($err !== NULL)
			return ($err);
		$oldname = mysqli_real_escape_string($conn, $oldname);
		$newname = mysqli_real_escape_string($conn, $newname);
		$req = "UPDATE cats SET name = '$newname' WHERE name = '$oldname'";
		$req = mysqli_query($conn, $req);
		if ($req !== FALSE)
			return true;
		return ($req);
	}

	function cat_delete(string $name)
	{
		$conn = connect_db();
		$name = mysqli_real_escape_string($conn, $name);
		$req = "DELETE FROM cats WHERE name = '$name'";
		$req = mysqli_query($conn, $req);
		return ($req);
	}

	function cat_get(string $name)
	{
		$conn = connect_db();
		$name = mysqli_real_escape_string($conn, $name);
		$req = "SELECT * FROM cats WHERE name = '$name'";
		$req = mysqli_query($conn, $req);
		if ($req !== FALSE)
			$req = mysqli_fetch_assoc($req);
		return ($req);
	}

	function cat_get_all()
	{
		$conn = connect_db();
		$req = "SELECT name FROM `cats` WHERE 1";
		$result = mysqli_query($conn, $req);
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			echo " Name: " . $row["name"]. "<br>";
		return (null);
	}
?>