<?php
// Verbinden met de 'partijen' database
$partijen_conn = new mysqli("localhost", "root", "", "partijen");

// Verbinden met de 'verkiezing_db' database (verander dit als de naam van deze database anders is)
$verkiezing_conn = new mysqli("localhost", "root", "", "verkiezing_db");

// Controleer verbindingen
if ($partijen_conn->connect_error) {
    die("Verbinding met 'partijen' database mislukt: " . $partijen_conn->connect_error);
}

if ($verkiezing_conn->connect_error) {
    die("Verbinding met 'verkiezing_db' database mislukt: " . $verkiezing_conn->connect_error);
}
?>
