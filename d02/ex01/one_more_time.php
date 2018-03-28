#!/usr/bin/php
<?php
function get_month($str)
{
	if ($str == "Janvier" | str == "janvier")
		$month = 1;
	if ($str == "Fevrier" | str == "fevrier" | str == "Février" | str == "février")
		$month = 2;
	if ($str == "Mars" | str == "mars")
		$month = 3;
	if ($str == "Avril" | str == "avril")
		$month = 4;
	if ($str == "Mai" | str == "mai")
		$month = 5;
	if ($str == "Juin" | str == "juin")
		$month = 6;
	if ($str == "Juillet" | str == "juillet")
		$month = 7;
	if ($str == "Aout" | str == "aout" || str == "Août" || str == "août")
		$month = 8;
	if ($str == "Septembre" | str == "septembre")
		$month = 9;
	if ($str == "Octobre" | str == "octobre")
		$month = 10;
	if ($str == "Novembre" | str == "novembre")
		$month = 11;
	if ($str == "Decembre" | str == "decembre" | "Décembre" | str == "décembre")
		$month = 12;
	return ($month);
}
if ($argc > 1)
{
	if (preg_match('/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche) ([0-9]{2}|[1-2][0-9]|3[0-1]) ([J|j]anvier|[Ff][eé]vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]o[uû]t|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd][eé]cembre) [0-9]{4} ([0-3][0-9]):([0-5][0-9]):([0-5][0-9])$/', $argv[1]) == 1)
	{
		date_default_timezone_set('Europe/Paris');
		$array = explode(' ', $argv[1]);
		$heures = explode(':', $array[4]);
		$month = get_month($array[2]);
		echo mktime($heures[0], $heures[1], $heures[2], $month, $array[1], $array[3]) . "\n";
	}
	else
		echo "Wrong Format\n";
}
?>