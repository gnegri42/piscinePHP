#!/usr/bin/php
<?php

if ($argc == 4)
{
	$tab = array();
	unset($argv[0]);
	foreach ($argv as $elem)
		$tab[] = trim($elem);
	if ($tab[1] == '+')
		echo $tab[0] + $tab[2] . "\n";
	else if ($tab[1] == '-')		
		echo ($tab[0] - $tab[2]) . "\n";
	else if ($tab[1] == '*')		
		echo ($tab[0] * $tab[2]) . "\n";
	else if ($tab[1] == '/')		
		echo ($tab[0] / $tab[2]) . "\n";
	else
		echo "0\n";
}
else
	echo "Incorrect Parameters\n";

?>