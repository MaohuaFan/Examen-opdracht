<?php
// auteur: Lorenzo van der Horst
// functie: insert class Partij

// Include the Partij class
include_once 'classes/partij.php';

// Check if the form is submitted
if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    // Retrieve and sanitize form input
    $partijnaam = filter_input(INPUT_POST, 'partijnaam', FILTER_SANITIZE_STRING);

    // Simple validation
    if ($partijnaam) {
        // Instantiate the Partij class
        $partij = new Partij();
        
        // Prepare the data to be inserted
        $row = [
            'partijnaam' => $partijnaam // Correct key for insertion
        ];

        // Insert the party
        if ($partij->insertPartij($row)) {
            echo "<p>Partij succesvol toegevoegd.</p>";
        } else {
            echo "<p>Fout bij het toevoegen van partij.</p>";
        }
    } else {
        echo "<p>Vul alstublieft alle velden correct in.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Voeg Partij Toe</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to your stylesheet -->
</head>
<body>

    <h1>CRUD Partij</h1>
    <h2>Toevoegen</h2>
    <form method="post">
        <label for="pn">Partijnaam:</label>
        <input type="text" id="pn" name="partijnaam" placeholder="Partijnaam" required/>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
    <br>

    <a href='read.php'>Terug</a> <!-- Link to return to the read page -->
</body>
</html>
