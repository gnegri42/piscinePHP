<?php
if ($_POST["login"] !== "" && $_POST["passwd"] !== "" && $_POST["submit"] === "OK")
{
	$file = "../private/passwd";
	if (!file_exists ("../private"))
		mkdir("../private");
	if (!file_exists($file))
		file_put_contents($file, NULL);
	$data = file_get_contents($file);
	$data = unserialize($data);
	if ($data)
	{
		foreach ($data as $elem => $value)
		{
			if ($value["login"] == $_POST["login"])
			{
				echo "ERROR\n";
				exit();
			}
		}
	}
	$user["login"] = $_POST["login"];
	$user["passwd"] = hash("whirlpool", $_POST["passwd"]);
	$data[] = $user;
	file_put_contents($file, serialize($data));
	echo "OK\n";
	header("Location: index.html");
}
else
	echo "ERROR\n";
?>