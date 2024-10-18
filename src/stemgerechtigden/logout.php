<?php
session_start(); // Start de sessie

// Vernietig de sessie om de gebruiker uit te loggen
session_destroy();

// Redirect naar de login.html pagina
header("Location: login.html");
exit();
?>
