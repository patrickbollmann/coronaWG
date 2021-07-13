<?php
include "/var/www/patrick/mobilofix.de/secret/secret.php";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, "corona_wg");
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
?>
