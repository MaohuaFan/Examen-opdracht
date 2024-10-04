<?php
// Verbinden met partijen_db
$partijen_conn = new mysqli("localhost", "root", "", "partijen_db");

// Verbinden met verkiezing_db
$verkiezing_conn = new mysqli("localhost", "root", "", "verkiezing_db");

// Controleer connecties
if ($partijen_conn->connect_error) {
    die("Verbinding met partijen_db mislukt: " . $partijen_conn->connect_error);
}

if ($verkiezing_conn->connect_error) {
    die("Verbinding met verkiezing_db mislukt: " . $verkiezing_conn->connect_error);
}
?>
