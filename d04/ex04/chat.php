<?php
  date_default_timezone_set("Europe/Paris");
  if (file_exists("../private/chat"))
  {
    $tab = unserialize(file_get_contents("../private/chat"));
    foreach ($tab as $elem)
      echo "[$elem["time"]]<b>$elem["login"]</b>: $elem["msg"]<br />\n";
  }
?>