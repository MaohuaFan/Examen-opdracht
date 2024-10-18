<?php
require 'config.php';  // Verbind met je database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];  // Verwijst nu naar het juiste invoerveld 'wachtwoord'

    // Controleer of het e-mailadres bestaat in de database
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($wachtwoord, $user['wachtword'])) {  // Gebruik 'wachtword' kolom in de database
        // Succesvolle login, zet een sessie of iets dergelijks op
        echo "Inloggen succesvol!";
        // Redirect naar beveiligde pagina of dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Ongeldige inloggegevens!";
    }
}
?>

<h2>Inloggen</h2>
<form method="POST" action="login.php">
    E-mail: <input type="email" name="email" required><br>
    Wachtwoord: <input type="password" name="wachtwoord" required><br>
    <input type="submit" value="Inloggen">
</form>

<p>Heb je nog geen account? <a href="register.php">Maak een account aan</a></p>

<p>Wachtwoord vergeten? <a href="reset_password.php">Wachtwoord resetten</a></p>
