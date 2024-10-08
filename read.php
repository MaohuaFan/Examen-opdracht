<!--
    Auteur: Lorenzo van der Horst
    Function: home page CRUD Partij
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Partij</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <h1>CRUD Partij</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insert.php'>Toevoegen nieuwe partij</a><br><br>
    </nav>

<?php
// Handmatig het bestand van de class Partij includen
require_once 'classes/Partij.php';

// Maak een object Partij
$partij = new Partij();

// Start CRUD
$partij->crudPartij();
?>
</body>
</html>
