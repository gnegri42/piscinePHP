#!/usr/bin/php
<?php
if ($argc == 2)
{
	$array = array_filter(explode(" ", $argv[1]));
	foreach ($array as $elem)
	{
		$str .= $elem." ";
	}
	echo trim($str) . "\n";
}
?>