<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=examenopdracht', 'root', ''); // Vervang 'username' en 'password' door je eigen gegevens
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Test de verbinding
    echo "Verbinding geslaagd!";
} catch (PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>
