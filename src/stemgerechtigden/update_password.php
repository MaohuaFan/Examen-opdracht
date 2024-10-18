<?php
require 'config.php';  // Verbind met je database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reset_token = $_POST['reset_token'];
    $new_password = $_POST['new_password'];

    // Zoek naar een gebruiker met deze token
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->execute([$reset_token]);
    $user = $stmt->fetch();

    if ($user) {
        // Versleutel het nieuwe wachtwoord
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update het wachtwoord en verwijder de token
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET wachtwoord = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
        $stmt->execute([$hashed_password, $reset_token]);

        echo "Je wachtwoord is succesvol bijgewerkt!";
        // Optioneel: redirect naar de login pagina
        header("Location: login.php");
        exit();
    } else {
        echo "De reset-token is ongeldig of verlopen.";
    }
}
?>

<h2>Reset je wachtwoord</h2>
<form method="POST" action="update_password.php">
    Nieuwe wachtwoord: <input type="password" name="new_password" required><br>
    <input type="hidden" name="reset_token" value="<?php echo $_GET['token']; ?>"><br>
    <input type="submit" value="Wachtwoord bijwerken">
</form>
