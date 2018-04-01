<?php
session_start();
$_SESSION["produits"] = NULL;
header("Location: panier.php");
?>