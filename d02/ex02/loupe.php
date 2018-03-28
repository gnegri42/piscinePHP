#!/usr/bin/php
<?php

if ($argc < 2 || !file_exists($argv[1]))
	exit();
$str = file_get_contents($argv[1]);
$str = preg_replace_callback("/<a href=\".+?\/a>/", function ($match) {return strtoupper($match[0]);}, $str);
$str = preg_replace_callback("/<.+ title=\".+\">/", function ($match) {return strtoupper($match[0]);}, $str);
$str = preg_replace_callback("/<.* title=\"/", function ($match) {return strtolower($match[0]);}, $str);
echo $str . "\n";

?>