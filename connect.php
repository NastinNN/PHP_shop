<?php
require_once("inc.php");
$mysqli=new mysqli($host, $user, $pwd, $db);
if ($mysqli->connect_errno)
  echo $mysqli->connect_errno;
else
  $mysqli->set_charset("utf8mb4");
?>