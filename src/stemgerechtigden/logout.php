<?php
session_start(); // Start de sessie

// Vernietig alle sessiegegevens
session_unset(); // Verwijder alle sessievariabelen
session_destroy(); // Vernietig de sessie

// Redirect naar de inlogpagina of de homepage
header("Location: ../stemgerechtigden/login.php"); // Of wijzig naar de gewenste pagina
exit();
?>
