<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; // Gebruik je eigen database naam

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>
