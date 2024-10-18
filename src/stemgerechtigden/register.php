<?php
session_start(); // Start de sessie

require 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtword = password_hash($_POST['wachtword'], PASSWORD_DEFAULT);

    // Voeg de nieuwe gebruiker toe aan de database
    $stmt = $pdo->prepare("INSERT INTO stemgerechtigden (Naam, email, wachtword) VALUES (?, ?, ?)");
    if ($stmt->execute([$naam, $email, $wachtword])) {
        // Redirect naar de login.html pagina na succesvolle registratie
        header("Location: login.html?register=success");
        exit();
    } else {
        echo "Registratie mislukt!";
    }
}
?>

<h2>Account aanmaken</h2>
<form method="POST" action="register.php">
    Naam: <input type="text" name="naam" required><br>
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtword" required><br>
    <input type="submit" value="Registreren">
</form>
