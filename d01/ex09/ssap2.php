#!/usr/bin/php
<?php
if ($argc > 1)
{
	unset($argv[0]);
	foreach ($argv as $elem)
	{
		$tmp = array_filter(explode(" ", $elem));
		foreach ($tmp as $elem2)
			$array[] = $elem2;
	}
	foreach ($array as $elem)
	{
		if (is_numeric($elem) == true || $elem == '0')
			$arraynum[] = $elem;
		else if (($elem[0] >= 'A' && $elem[0] <= 'Z') || ($elem[0] >= 'a' && $elem[0] <= 'z'))
			$arrayalpha[] = $elem;
		else
			$array2[] = $elem;
	}
	if ($arrayalpha != NULL)
		natcasesort($arrayalpha);
	if ($array2 != NULL)
		natcasesort($array2);
	$i = 0;
	$j = 0;
	$k = 0;
	while ($i < count($arraynum) - 1)
	{
		$j = $i + 1;
		while ($j < count($arraynum))
		{
			$k = 0;
			while ($arraynum[$i][$k] == $arraynum[$j][$k])
				$k++;
			if ($arraynum[$i][$k] > $arraynum[$j][$k])
			{
				$temp = $arraynum[$i];
				$arraynum[$i] = $arraynum[$j];
				$arraynum[$j] = $temp;
			}
			$j++;
		}
		$i++;
	}
	if ($arrayalpha != NULL)
	{
		foreach ($arrayalpha as $elem)
			echo "$elem\n";
	}
	if ($arraynum != NULL)
	{
		foreach ($arraynum as $elem)
			echo "$elem\n";
	}
	if ($array2 != NULL)
	{
		foreach ($array2 as $elem)
			echo "$elem\n";
	}
}
?>