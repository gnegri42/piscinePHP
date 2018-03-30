<?php
function auth($login, $passwd)
{
	$file = "../private/passwd";
	$tab = unserialize(file_get_contents($file));
	if ($tab)
	{
		foreach ($tab as $elem => $value)
		{
			if ($value["login"] === $login && $value["passwd"] === hash("whirlpool", $passwd))
				return (TRUE);
		}
	}
	return (FALSE);
}
?>