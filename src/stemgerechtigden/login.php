<?php
session_start(); // Start de sessie

require 'config.php'; // Verbind met de database

// Debug: Controleer of de include werkt
if (isset($_SESSION['user_id'])) {
    echo "<p>User is logged in as: " . htmlspecialchars($_SESSION['user_name']) . "</p>";
} else {
    echo "<p>User is not logged in</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Zoek de gebruiker op e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Controleer of de gebruiker bestaat en het wachtwoord klopt
    if ($user && $wachtwoord === $user['wachtwoord']) {
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
<header>
    <?php 
    include '../nav.php'; // Include de navigatiebalk 
    ?>
</header>
<h2>Inloggen</h2>

<form method="POST" action="login.php">
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <input type="submit" value="Inloggen">
</form>
<p>Heb je nog geen account? <a href="register.php">Maak een account aan</a></p>
