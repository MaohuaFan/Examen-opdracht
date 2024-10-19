<?php
session_start();
require 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Controleer of het e-mailadres bestaat
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Genereer een unieke token voor wachtwoordherstel
        $token = bin2hex(random_bytes(50));

        // Voeg de token toe aan de database en stel een vervaldatum in
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET reset_token = ?, reset_token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?");
        $stmt->execute([$token, $email]);

        // Verstuur de reset-link via een eenvoudige mail (gebruik PHPMailer voor productie)
        $resetLink = "http://localhost/Examen-opdracht/src/stemgerechtigden/new_password.php?token=" . $token;
        // Hier moet je de mail-functie gebruiken in productie
        echo "<p>Reset link: <a href='$resetLink'>$resetLink</a></p>";  // Debug: toon de link direct
    } else {
        echo "<p>Geen gebruiker gevonden met dit e-mailadres.</p>";
    }
}
?>

<h2>Wachtwoord resetten</h2>
<form method="POST" action="reset_password.php">
    Vul je e-mailadres in: <input type="email" name="email" required><br>
    <input type="submit" value="Verzend reset-link">
</form>
