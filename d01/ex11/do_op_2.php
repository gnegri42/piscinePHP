#!/usr/bin/php
<?php
function ft_split($str, $delim)
{
	$tab = array_filter(explode($delim, $str));
	return ($tab);
}

if ($argc == 2)
{
	unset($argv[0]);
	$i = 0;
	while ($argv[1][$i])
	{
		if ($argv[1][$i] == '+')
		{
			$op = '+';
			$tab = ft_split($argv[1], '+');
		}
		else if ($argv[1][$i] == '-')
		{
			$op = '-';
			$tab = ft_split($argv[1], '-');
		}
		else if ($argv[1][$i] == '*')
		{
			$op = '*';
			$tab = ft_split($argv[1], '*');
		}
		else if ($argv[1][$i] == '/')
		{
			$op = '/';
			$tab = ft_split($argv[1], '/');
		}
		$i++;
	}
	if ($tab != NULL)
	{
		foreach ($tab as $elem)
		{
			$tab2[] = trim($elem);
			if (is_numeric(trim($elem)) == FALSE)
			{
				echo "Syntax Error\n";
				exit();
			}
		}
		if ($op == '+')
			echo $tab2[0] + $tab2[1] . "\n";
		else if ($op == '-')		
			echo ($tab2[0] - $tab2[1]) . "\n";
		else if ($op == '*')		
			echo ($tab2[0] * $tab2[1]) . "\n";
		else if ($op == '/')		
			echo ($tab2[0] / $tab2[1]) . "\n";
		else
			echo "0\n";
	}
	else
		{
			echo "Syntax Error\n";
			exit();
		}
}
else
	echo "Incorrect Parameters\n";

?>