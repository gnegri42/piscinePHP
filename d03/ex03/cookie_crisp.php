<?PHP
if ($_GET["action"] && $_GET["name"])
{
	if ($_GET["action"] === "set")
	{
		$value = $_GET["value"] ? $_GET["value"] : "";
		setcookie($_GET["name"], $value, time() + 24 * 3600);
	}
	else if ($_GET["action"] === "get" && $_COOKIE[$_GET["name"]])
		echo $_COOKIE[$_GET["name"]]."\n";
	else if ($_GET["action"] === "del")
		setcookie($_GET["name"], "", 0);
}
?>