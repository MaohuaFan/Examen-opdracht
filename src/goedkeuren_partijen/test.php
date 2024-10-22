<?php 
 session_start();
 require_once '../../vendor/autoload.php';
 include '../nav.php'; // Navigatiebalk 
?>


<?php
// src/goedkeuren_partijen/test.php

// Foutmeldingen inschakelen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Databaseverbinding maken
$host = 'localhost';
$db = 'examenopdracht'; // Pas dit aan naar jouw database naam
$user = 'root'; // Je database gebruiker
$pass = ''; // Je database wachtwoord

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kan geen verbinding maken met de database: " . $e->getMessage());
}

// Laad de GoedkeurenPartij klasse
require_once 'GoedkeurenPartij.php';

// Creëer een instantie van de GoedkeurenPartij klasse
$goedkeurenPartij = new GoedkeurenPartij($pdo);

// Controleer of het formulier is ingediend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $partij_id = $_POST['partij_id'];
    $opmerkingen = $_POST['opmerkingen'];
    $actie = $_POST['actie'];

    if ($actie === 'goedkeuren') {
        $result = $goedkeurenPartij->keurPartijGoed($partij_id, $opmerkingen);
    } elseif ($actie === 'afkeuren') {
        $result = $goedkeurenPartij->keurPartijAf($partij_id, $opmerkingen);
    }

    echo "<p>$result</p>"; // Toon het resultaat van de actie
}

// Haal de lijst van partijen op en toon deze
$partijen = $goedkeurenPartij->getPartijen();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Goedkeuren Partijen</title>
</head>
<body>
    <h2>Lijst van Partijen:</h2>
    <table border='1'>
        <tr>
            <th>Partij ID</th>
            <th>Partij Naam</th>
            <th>Goedkeuring Status</th>
            <th>Actie</th>
        </tr>
        <?php foreach ($partijen as $partij): ?>
            <tr>
                <td><?php echo $partij['Partij_ID']; ?></td>
                <td><?php echo $partij['Partij_Naam']; ?></td>
                <td><?php echo $partij['Goedkeuring_Status']; ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="partij_id" value="<?php echo $partij['Partij_ID']; ?>">
                        <input type="text" name="opmerkingen" placeholder="Opmerkingen" required>
                        <button type="submit" name="actie" value="goedkeuren">Goedkeuren</button>
                        <button type="submit" name="actie" value="afkeuren">Afkeuren</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
