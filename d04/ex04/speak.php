<?php
session_start();
date_default_timezone_set("Europe/Paris");
if ($_SESSION["logged_on_user"] && $_POST["submit"] === "OK" && $_POST["msg"] !== "")
{
	$path = "../private/chat";
	if (!file_exists($path))
		file_put_contents($path, NULL);
	$data = file_get_contents($path);
	$file = fopen($path, "r+");
	flock($file, LOCK_EX);
	$data = unserialize($data);
	$chat["login"] = $_SESSION["logged_on_user"];
	$chat["msg"] = $_POST["msg"];
	$chat["time"] = time();
	$data[] = $chat;
	file_put_contents($path, $data);
	fclose($file);
}
else
{
	echo "ERROR\n";
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
	</head>
	<body>
		<form method="post" action="speak.php">
			<input type="text" name="msg" value="" />
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>
