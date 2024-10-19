<?php
require 'config.php'; // Verbind met de database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nieuwWachtwoord = password_hash($_POST['nieuw_wachtwoord'], PASSWORD_DEFAULT);

    // Zoek de gebruiker met de juiste token en controleer of deze niet verlopen is
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Werk het wachtwoord bij in de database
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET wachtwoord = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->execute([$nieuwWachtwoord, $token]);

        echo "<p>Je wachtwoord is succesvol bijgewerkt. Je kunt nu inloggen.</p>";
    } else {
        echo "<p>De token is ongeldig of verlopen.</p>";
    }
}
?>

<h2>Nieuw wachtwoord instellen</h2>
<form method="POST" action="reset_form.php">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    Nieuw wachtwoord: <input type="password" name="nieuw_wachtwoord" required><br>
    <input type="submit" value="Wachtwoord Bijwerken">
</form>
