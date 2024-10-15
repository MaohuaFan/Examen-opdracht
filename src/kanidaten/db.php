<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; // Zorg ervoor dat deze naam overeenkomt met de aangemaakte database

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
