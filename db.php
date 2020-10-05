<?php
include "/var/www/patrickbollmann.de/html/secret/secret.php";

$mysqli = new mysqli("localhost", $dbuser, $dbpass, "CoronaWG");
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
?>
