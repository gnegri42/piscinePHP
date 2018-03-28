#!/usr/bin/php
<?php
function is_even($i)
{
	if ($i % 2 == 0)
		return(1);
	else
		return(0);
}

$input = fopen("php://stdin", "r");
while ($input)
{
	echo "Entrez un nombre: ";
	$num = fgets($input);
	if (feof($input))
		break ;
	if ($num)
		$num = str_replace("\n", "", "$num");
	if (is_numeric($num))
	{
		$str = substr($num, -1);
		if (is_even($str) == 1)
			echo "Le chiffre " . $num . " est Pair\n";
		else
			echo "Le chiffre " . $num . " est Impair\n";
	}
	else
		echo "'" . $num . "' n'est pas un chiffre\n";
}
echo "\n";
fclose($input);
?>