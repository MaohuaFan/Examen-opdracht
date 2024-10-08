<?php
// auteur: Maohua Fan
// functie: insert class Verkiezing

require_once '../../vendor/autoload.php'; // Zorg ervoor dat dit het juiste pad is naar de autoload

use Examenopdracht\classes\Verkiezing;

// Maak een instantie van de Verkiezing-klasse
$verkiezingen = new Verkiezing("", "", "", 0); // Je kunt de parameters hier negeren omdat we ze later instellen

// Verkrijg de verkiezingstypes
$verkiezingTypes = $verkiezingen->getVerkiezingTypes();

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $verkiezingsnaam = $_POST['naam'];
    $verkiezingsdatumStart = $_POST['startdatum'];
    $verkiezingsdatumEind = $_POST['einddatum'];
    $verkiezingstypeId = $_POST['type'];

    // Maak het Verkiezing-object aan met de juiste parameters
    $verkiezing = new Verkiezing($verkiezingsnaam, $verkiezingsdatumStart, $verkiezingsdatumEind, $verkiezingstypeId);

    // Roep de registreerVerkiezing-methode aan
    $insertedId = $verkiezing->registreerVerkiezing(); 

    if ($insertedId !== false) {
        echo "Verkiezing toegevoegd! De nieuwe verkiezing ID is: $insertedId";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de verkiezing.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Verkiezing Toe</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Voeg Verkiezing Toe</h1>
    <form method="post">
        <label for="naam">Verkiezingsnaam:</label>
        <input type="text" id="naam" name="naam" placeholder="Verkiezingsnaam" required/><br>

        <label for="startdatum">Startdatum:</label>
        <input type="date" id="startdatum" name="startdatum" required/><br>

        <label for="einddatum">Einddatum:</label>
        <input type="date" id="einddatum" name="einddatum" required/><br>

        <label for="type">Verkiezingstype:</label>
        <select id="type" name="type" required>
            <option value="" disabled selected>Kies een verkiezingstype</option>
            <?php foreach ($verkiezingTypes as $type): ?>
                <option value="<?php echo $type['VerkiezingType_ID']; ?>">
                    <?php echo htmlspecialchars($type['VerkiezingType_Naam']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type='submit' name='insert' value='Toevoegen'>
    </form>
</body>
</html>
