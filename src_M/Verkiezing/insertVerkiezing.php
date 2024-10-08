<?php
// auteur: Maohua Fan
// functie: insert class Verkiezing

// Autoloader classes via composer
require '../../vendor/autoload.php'; // Pas het pad aan indien nodig
use Examenopdracht\classes\Verkiezing;

$verkiezing = new Verkiezing(); 

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $verkiezingsnaam = $_POST['naam'];
    $verkiezingsdatum = $_POST['datum'];
    $verkiezingstype = $_POST['type'];

    $row = [
        'naam' => $verkiezingsnaam,
        'datum' => $verkiezingsdatum,
        'type' => $verkiezingstype, 
    ];

    $insertedId = $verkiezing->registreerVerkiezing($row); // Zorg ervoor dat deze functie bestaat in je Verkiezing klasse

    if ($insertedId !== false) {
        echo "Verkiezing toegevoegd! De nieuwe verkiezingID is: $insertedId";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de verkiezing.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Verkiezing</title>
    <link rel="stylesheet" href="../style.css"> <!-- Zorg ervoor dat je stylesheet correct is -->
</head>
<body>
    <?php include_once('../nav.php'); ?> <!-- Navigatiebalk -->
    
    <h1>CRUD Verkiezing</h1>
    <h2>Toevoegen</h2>
    
    <form method="post">
        <label for="naam">Verkiezingsnaam:</label>
        <input type="text" id="naam" name="naam" placeholder="Verkiezingsnaam" required/>
        <br>
        
        <label for="datum">Verkiezingsdatum:</label>
        <input type="date" id="datum" name="datum" required/>
        <br>
        
        <label for="type">Verkiezingstype:</label>
        <select id="type" name="type" required>
            <option value="">Selecteer een type</option>
            <option value="1">Landelijk</option>
            <option value="2">Regionaal</option>
            <option value="3">Referendum</option>
            <!-- Voeg hier meer opties toe indien nodig -->
        </select>
        <br><br>
        
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>
    
    <a href='read.php'>Terug</a> <!-- Link om terug te gaan naar de lijst -->
</body>
</html>
