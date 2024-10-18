<?php
require 'config.php';  // Verbind met je database

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        
        // Werk het wachtwoord bij en verwijder de token
        $stmt = $pdo->prepare("UPDATE stemgerechtigden SET wachtwoord = ?, reset_token = NULL WHERE reset_token = ?");
        $stmt->execute([$newPassword, $token]);

        echo "Je wachtwoord is succesvol gereset!";
        header("Location: login.php");
        exit;
    }
} else {
    echo "Ongeldige of verlopen resetlink.";
}
?>

<form method="POST">
    Nieuw wachtwoord: <input type="password" name="new_password" required><br>
    <input type="submit" value="Reset Wachtwoord">
</form>
