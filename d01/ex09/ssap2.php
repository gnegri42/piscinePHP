#!/usr/bin/php
<?php
function calc_ascii($c)
{
	$ascii = ord($c);
	if (is_numeric($c))
		$ascii += 300;
	else if (($c >= 'A' && $c <= 'Z'))
		$ascii += 32;
	if ($c < '0' || ($c > 'Z' && $c < 'a') || $c > 'z')
		$ascii += 600;
	return ($ascii);
}

function swapper($str1, $str2)
{
	$s_str1_len = strlen($str1);
	$s_str2_len = strlen($str2);
	$i = 0;
	$tab_str1 = str_split($str1, 1);
	$tab_str2 = str_split($str2, 1);
	if ($str1 == $str2)
		return (0);
	while ($i < $s_str1_len && $i < $s_str2_len)
	{
		$str1_ascii = calc_ascii($tab_str1[$i]);
		$str2_ascii = calc_ascii($tab_str2[$i]);
		if ($str1_ascii != $str2_ascii)
		{
			if ($str1_ascii < $str2_ascii)
				return (-1);
			else
				return (1);
		}
		$i++;
	}
}

if ($argc < 2)
	exit ();
unset($argv[0]);
$array = array();
foreach ($argv as $elem)
{
	$tmp = array_filter(explode(" ", $elem));
	foreach ($tmp as $elem2)
		$array[] = $elem2;
}
usort($array, "swapper");
foreach ($array as $elem)
	echo $elem."\n";
?>