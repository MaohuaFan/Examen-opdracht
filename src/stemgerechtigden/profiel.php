<?php
session_start(); // Start de sessie
require '../stemgerechtigden/config.php'; // Verbind met de database

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: ../stemgerechtigden/login.php"); // Redirect als de gebruiker niet is ingelogd
    exit();
}

// Haal de gegevens van de ingelogde gebruiker op
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM stemgerechtigden WHERE Stemgerechtigde_ID = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Controleer of de gebruiker bestaat
if (!$user) {
    echo "Gebruiker niet gevonden.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Profiel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include '../nav.php'; // Navigatiebalk ?>

<div class="container">
    <h2>Mijn Profiel</h2>
    <p><strong>Naam:</strong> <?php echo htmlspecialchars($user['Naam']); ?></p>
    <p><strong>E-mailadres:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    
    <a href="wachtwoord-reset.php" class="btn btn-warning">Wachtwoord Resetten</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
