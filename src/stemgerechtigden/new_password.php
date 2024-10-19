<?php
require 'config.php'; // Verbind met de database

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Controleer of de token geldig is en niet verlopen
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = $_POST['new_password']; // Wachtwoord in platte tekst

            // Update het wachtwoord in de database en verwijder de token
            $stmt = $pdo->prepare("UPDATE stemgerechtigden SET wachtwoord = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
            $stmt->execute([$new_password, $token]);

            echo "<p>Je wachtwoord is succesvol bijgewerkt! Je kunt nu <a href='login.php'>inloggen</a>.</p>";
            exit();
        }
    } else {
        echo "<p>De reset-token is ongeldig of verlopen.</p>";
        exit();
    }
} else {
    echo "<p>Ongeldige aanvraag.</p>";
    exit();
}
?>

<h2>Nieuw wachtwoord instellen</h2>
<form method="POST" action="new_password.php?token=<?php echo htmlspecialchars($token); ?>">
    Nieuw wachtwoord: <input type="password" name="new_password" required><br>
    <input type="submit" value="Wachtwoord resetten">
</form>
