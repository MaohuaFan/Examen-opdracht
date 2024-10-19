<?php
session_start(); // Start de sessie
require '../stemgerechtigden/config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: ../stemgerechtigden/login.php"); // Redirect als de gebruiker niet is ingelogd
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $huidig_wachtwoord = $_POST['huidig_wachtwoord'];
    $nieuw_wachtwoord = $_POST['nieuw_wachtwoord'];
    $bevestig_wachtwoord = $_POST['bevestig_wachtwoord'];

    // Haal de huidige gegevens van de gebruiker op
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE Stemgerechtigde_ID = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    // Controleer of het huidige wachtwoord klopt
    if ($user && $huidig_wachtwoord == $user['wachtwoord']) { // Vergelijk wachtwoord zonder hashing
        // Controleer of de nieuwe wachtwoorden overeenkomen
        if ($nieuw_wachtwoord == $bevestig_wachtwoord) {
            // Update het wachtwoord in platte tekst in de database
            $stmt = $pdo->prepare("UPDATE stemgerechtigden SET wachtwoord = ? WHERE Stemgerechtigde_ID = ?");
            $stmt->execute([$nieuw_wachtwoord, $user_id]);

            echo "Wachtwoord succesvol gewijzigd!";
        } else {
            echo "De nieuwe wachtwoorden komen niet overeen.";
        }
    } else {
        echo "Het huidige wachtwoord is onjuist.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord Resetten</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include '../nav.php'; // Navigatiebalk ?>

<div class="container">
    <h2>Wachtwoord Resetten</h2>
    <form method="POST" action="wachtwoord-reset.php">
        <div class="form-group">
            <label for="huidig_wachtwoord">Huidig Wachtwoord:</label>
            <input type="password" class="form-control" name="huidig_wachtwoord" required>
        </div>
        <div class="form-group">
            <label for="nieuw_wachtwoord">Nieuw Wachtwoord:</label>
            <input type="password" class="form-control" name="nieuw_wachtwoord" required>
        </div>
        <div class="form-group">
            <label for="bevestig_wachtwoord">Bevestig Wachtwoord:</label>
            <input type="password" class="form-control" name="bevestig_wachtwoord" required>
        </div>
        <button type="submit" class="btn btn-primary">Wachtwoord Resetten</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>
</html>
