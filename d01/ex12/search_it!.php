#!/usr/bin/php
<?php
function ft_split($str, $delim)
{
	$tab = array_filter(explode($delim, $str));
	return ($tab);
}
if ($argc < 3)
{
	exit ();
}
$clef = $argv[1];
unset($argv[0], $argv[1]);
$rev = array_reverse($argv);
foreach ($rev as $elem)
{
	$tab = ft_split($elem, ':');
	if ($tab[0] == $clef)
	{
		echo "$tab[1]\n";
		exit();
	}
}
?>