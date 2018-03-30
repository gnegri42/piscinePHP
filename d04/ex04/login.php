<?php
session_start();
include ("auth.php");
if (auth($_POST["login"], $_POST["passwd"]))
{
	$_SESSION["logged_on_user"] = $_POST["login"];
	echo "OK\n";
?> 
	<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
	<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>

<?php
}
else
{
	$_SESSION["logged_on_user"] = "";
	echo "ERROR\n";
}
?>