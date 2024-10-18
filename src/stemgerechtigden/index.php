<?php
session_start(); // Start de sessie

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    // Als de gebruiker niet is ingelogd, redirect naar de loginpagina
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Homepagina</title>
</head>
<body>

<!-- Toon de naam van de ingelogde gebruiker links bovenaan -->
<div style="position: absolute; top: 10px; left: 10px;">
    Ingelogd als: <strong><?php echo $_SESSION['user_name']; ?></strong>
</div>

<h1>Welkom op de Homepagina</h1>
<p>Dit is de homepagina van de website.</p>

<!-- Log uit knop -->
<form action="logout.php" method="POST">
    <input type="submit" value="Uitloggen">
</form>

</body>
</html>
