<?php
session_start();
require 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Zoek de gebruiker op e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Controleer of de gebruiker bestaat en het wachtwoord klopt
    if ($user && $wachtwoord === $user['wachtwoord']) { // Geen hashing meer
        // Sla de naam en andere gegevens op in de sessie
        $_SESSION['user_id'] = $user['Stemgerechtigde_ID'];
        $_SESSION['user_name'] = $user['Naam'];

        // Redirect naar index.php
        header("Location: ../index.php");
        exit();
    } else {
        echo "<p style='color: red;'>Ongeldige inloggegevens!</p>";
    }
}
?>

<h2>Inloggen</h2>
<form method="POST" action="login.php">
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <input type="submit" value="Inloggen">
</form>
<p>Wachtwoord vergeten? <a href="reset_password.php">Reset je wachtwoord</a></p>
<p>Account Registreren? <a href="../Stemgerechtigde/insertStemgerechtigde.php">Account Aanmaken</a></p>