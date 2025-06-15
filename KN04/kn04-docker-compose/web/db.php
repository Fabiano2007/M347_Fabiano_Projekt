<?php
$mysqli = new mysqli("m347-kn04a-db", "webuser", "webpw", "schule");
if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
echo "Verbindung erfolgreich!";
?>
