<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; // Je database naam

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal politieke partijen op
$partijenSql = "SELECT id, partijnaam FROM partijen";
$partijenResult = $conn->query($partijenSql);

// Haal verkiezingen op
$verkiezingenSql = "SELECT id, verkiezingsnaam FROM verkiezingen";
$verkiezingenResult = $conn->query($verkiezingenSql);
?>
