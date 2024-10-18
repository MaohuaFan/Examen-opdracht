<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

echo "Welkom, " . $_SESSION['Naam'];
?>
<p><a href="logout.php">Uitloggen</a></p>
