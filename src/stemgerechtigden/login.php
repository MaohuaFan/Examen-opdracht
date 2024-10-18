<?php
session_start(); // Start de sessie

require 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtword = $_POST['wachtword'];

    // Zoek de gebruiker op e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Controleer of de gebruiker bestaat en het wachtwoord klopt
    if ($user && password_verify($wachtword, $user['wachtword'])) {
        // Sla de naam en andere gegevens op in de sessie
        $_SESSION['user_id'] = $user['Stemgerechtigde_ID'];
        $_SESSION['user_name'] = $user['Naam'];

        // Redirect naar index.html
        header("Location: ../index.html");
        exit();
    } else {
        echo "Ongeldige inloggegevens!";
    }
}
?>

<h2>Inloggen</h2>
<form method="POST" action="login.php">
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtword" required><br>
    <input type="submit" value="Inloggen">
</form>
<p>Heb je nog geen account? <a href="register.php">Maak een account aan</a></p>
