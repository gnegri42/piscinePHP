<?php
if ($_POST["login"] !== "" && $_POST["oldpw"] !== "" && $_POST["newpw"] !== "" && $_POST["submit"] === "OK")
{
	$file = "../private/passwd";
	$tab = unserialize(file_get_contents($file));
	if ($tab)
	{
		foreach ($tab as $elem => $value)
		{
			if ($value["login"] === $_POST["login"] && $value["passwd"] === hash("whirlpool", $_POST["oldpw"]))
			{
				$tab[$elem]["passwd"] = hash("whirlpool", $_POST["newpw"]);
				file_put_contents($file, serialize($tab));
				echo "OK\n";
				header("Location: index.html");
			}
		}
	}
}
echo "ERROR\n";
?>
