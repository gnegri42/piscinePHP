#!/usr/bin/php
<?php
if ($argc > 1)
{
	$pattern = '/ +|\t+/';
	echo trim(preg_replace($pattern, ' ', $argv[1])) . "\n";
}
?>