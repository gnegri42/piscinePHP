<?php

function connect_db()
{
	$conn = mysqli_connect("localhost", "root", "admin1");
	if (!$conn) 
	{
		die("Connection failed: " . mysqli_connect_error());
		return (NULL);
	}
	return $conn;
}

function query_db($query)
{
	$conn = mysqli_connect("localhost", "root", "admin1");
	// Check connection
	if (!$conn) 
	    die("Connection failed: " . mysqli_connect_error());
	mysqli_select_db($conn, "eshop");

	$result = mysqli_query($conn, $query);

	mysqli_close($conn);
	return ($result);
}
?>