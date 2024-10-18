<?php
require 'config.php';  // Verbind met je database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Zoek de gebruiker op e-mailadres
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Genereer een reset token
        $reset_token = bin2hex(random_bytes(50));
        $reset_token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));  // Token vervalt na 1 uur

        // Update de database met het reset token en de vervaldatum
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->execute([$reset_token, $reset_token_expiry, $email]);

        // Simuleer het verzenden van de reset link naar het e-mailadres
        // Hier zou je normaal gesproken een echte e-mail sturen met een link
        echo "Een e-mail met een reset link is verzonden naar $email.<br>";
        echo "Klik hier om je wachtwoord te resetten: <a href='update_password.php?token=$reset_token'>Wachtwoord resetten</a>";
    } else {
        echo "E-mailadres niet gevonden!";
    }
}
?>

<h2>Wachtwoord Reset</h2>
<form method="POST" action="reset_password.php">
    Vul je e-mailadres in: <input type="email" name="email" required><br>
    <input type="submit" value="Reset Wachtwoord">
</form>
    