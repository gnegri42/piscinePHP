<?php
session_start();
$_SESSION["logged_on_user"] = NULL;
header("Location: login.php");
?>