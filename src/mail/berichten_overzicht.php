<?php
// src/mail/berichten_overzicht.php

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

// Haal de lijst van ontvangers op uit de database
$stmt = $pdo->query("SELECT Gebruiker_ID, Naam FROM gebruikers");
$gebruikers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Haal de berichten op uit de database (optioneel)
$stmtBerichten = $pdo->query("SELECT Bericht_ID, Onderwerp FROM berichten"); // Voeg dit toe als je berichten nodig hebt
$berichten = $stmtBerichten->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Berichten Overzicht</title>
</head>
<body>
    <h2>Bericht Versturen</h2>
    
    <form method="POST" action="verzend_bericht.php">
        <label for="ontvanger">Kies de ontvanger:</label>
        <select name="ontvanger" id="ontvanger">
            <?php foreach ($gebruikers as $gebruiker): ?>
                <option value="<?php echo $gebruiker['Gebruiker_ID']; ?>">
                    <?php echo $gebruiker['Naam']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <br><br>
        
        <label for="naam">Kies een naam:</label>
        <select name="naam" id="naam">
            <?php foreach ($gebruikers as $gebruiker): ?>
                <option value="<?php echo $gebruiker['Naam']; ?>">
                    <?php echo $gebruiker['Naam']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <br><br>
        
        <label for="onderwerp">Onderwerp:</label>
        <select name="onderwerp" id="onderwerp">
            <?php foreach ($berichten as $bericht): ?>
                <option value="<?php echo $bericht['Bericht_ID']; ?>">
                    <?php echo $bericht['Onderwerp']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <br><br>
        
        <button type="submit">Verzend Bericht</button>
    </form>
    
</body>
</html>
