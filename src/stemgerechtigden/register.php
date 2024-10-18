<?php
require 'config.php';  // Verbind met je database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $geboortedatum = $_POST['geboortedatum'];
    $woonplaats = $_POST['woonplaats'];
    $email = $_POST['email'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_BCRYPT);

    // Controleer of het e-mailadres al bestaat
    $checkStmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $checkStmt->execute([$email]);
    if ($checkStmt->rowCount() > 0) {
        echo "Dit e-mailadres is al geregistreerd!";
    } else {
        // Voorbereiden van de SQL query (met correcte kolomnaam 'wachtword')
        $stmt = $pdo->prepare("INSERT INTO stemgerechtigden (Naam, Geboortedatum, Woonplaats, email, wachtword) 
                               VALUES (?, ?, ?, ?, ?)");
        
        // Execute met de ingevulde waarden
        if ($stmt->execute([$naam, $geboortedatum, $woonplaats, $email, $wachtwoord])) {
            echo "Registratie succesvol!";
            // Redirect naar de loginpagina
            header("Location: login.php");
            exit();  // Stop verdere uitvoering van de script
        } else {
            echo "Er is iets misgegaan bij het registreren.";
        }
    }
}
?>

<h2>Account Aanmaken</h2>
<form method="POST">
    Naam: <input type="text" name="naam" required><br>
    Geboortedatum: <input type="date" name="geboortedatum" required><br>
    Woonplaats: <input type="text" name="woonplaats" required><br>
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <input type="submit" value="Registreren">
</form>

<p>Heb je al een account? <a href="login.php">Log hier in</a></p>
