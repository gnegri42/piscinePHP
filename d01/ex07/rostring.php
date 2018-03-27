#!/usr/bin/php
<?php

if ($argc > 0)
{
	$array = array();
	unset($argv[0]);
	$tmp = array_filter(explode(" ", $argv[1]));
	foreach ($tmp as $elem)
		$array[] = $elem;
	array_push($array, $array[0]);
	unset($array[0]);
	foreach ($array as $elem)
	{
		$str .= $elem." ";
	}
	trim($str);
	echo "$str\n";
}

?>