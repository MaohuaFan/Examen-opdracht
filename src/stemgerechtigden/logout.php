<?php
session_start();
session_unset();  // Verwijder alle sessievariabelen
session_destroy();  // Beëindig de sessie
header("Location: login.php");
exit;
?>
