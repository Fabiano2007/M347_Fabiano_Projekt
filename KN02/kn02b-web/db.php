<?php
$mysqli = new mysqli("kn02b-db", "webuser", "webpw", "schule");
if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
echo "Verbindung erfolgreich!";
?>
