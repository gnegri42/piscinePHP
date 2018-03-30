<?php
session_start();
if ($_SESSION["logged_on_user"] !== NULL)
	echo $_SESSION["logged_on_user"] . "\n";
else
	echo "ERROR\n";
?>