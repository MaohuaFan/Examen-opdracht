<?php
require 'config.php';  // Verbind met je database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Controleer of e-mail bestaat
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Genereer een token
        $token = bin2hex(random_bytes(50));

        // Token opslaan in de database
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET reset_token = ? WHERE email = ?");
        $stmt->execute([$token, $email]);

        // Stel de resetlink samen
        $resetLink = "http://localhost/reset_password_confirm.php?token=" . $token;
        echo "Reset je wachtwoord via de volgende link: <a href='$resetLink'>$resetLink</a>";
    } else {
        echo "Geen gebruiker gevonden met dit e-mailadres.";
    }
}
?>

<form method="POST">
    Vul je e-mailadres in om je wachtwoord te resetten: <input type="email" name="email" required><br>
    <input type="submit" value="Reset Wachtwoord">
</form>
