#!/usr/bin/php
<?php
if ($argc > 1)
{
	$array = array();
	unset($argv[0]);
	foreach ($argv as $elem)
	{
		$tmp = array_filter(explode(" ", $elem));
		foreach ($tmp as $elem2)
			$array[] = $elem2;
	}
	sort($array);
	foreach ($array as $elem)
		echo "$elem\n";
}
?>