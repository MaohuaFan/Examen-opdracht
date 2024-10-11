<?php
    // Auteur: Maohua Fan
    // Functie: Insert class Verkiezing

    require_once '../../vendor/autoload.php';

    use Examenopdracht\classes\Verkiezing;

    // Maak een instantie van de Verkiezing-klasse
    $verkiezingen = new Verkiezing("", "", "", 0); // Je kunt de parameters hier negeren omdat we ze later instellen

    // Verkrijg de verkiezingstypes
    $verkiezingTypes = $verkiezingen->getVerkiezingTypes();

    $foutmelding = "";

    if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
        $verkiezingsnaam = $_POST['naam'];
        $verkiezingsdatumStart = $_POST['startdatum'];
        $verkiezingsdatumEind = $_POST['einddatum'];
        $verkiezingstypeId = $_POST['type'];

        // Validatie: Controleer of de startdatum eerder is dan de einddatum
        if (strtotime($verkiezingsdatumStart) > strtotime($verkiezingsdatumEind)) {
            $foutmelding = "De startdatum moet eerder zijn dan de einddatum.";
        } else {
            // Maak het Verkiezing-object aan met de juiste parameters
            $verkiezing = new Verkiezing($verkiezingsnaam, $verkiezingsdatumStart, $verkiezingsdatumEind, $verkiezingstypeId);

            // Roep de registreerVerkiezing-methode aan
            $insertedId = $verkiezing->registreerVerkiezing();

            if ($insertedId !== false) {
                echo "Verkiezing toegevoegd! De nieuwe verkiezing ID is: $insertedId";
            } else {
                $foutmelding = "Er is een fout opgetreden bij het toevoegen van de verkiezing.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Verkiezing Toe</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Voeg Verkiezing Toe</h1>

    <!-- Toon foutmelding indien aanwezig -->
    <?php if (!empty($foutmelding)): ?>
        <div class="error-message"><?= $foutmelding ?></div>
    <?php endif; ?>

    <form method="post">
        <label for="naam">Verkiezingsnaam:</label>
        <input type="text" id="naam" name="naam" placeholder="Verkiezingsnaam" required value="<?= isset($verkiezingsnaam) ? htmlspecialchars($verkiezingsnaam) : ''; ?>"/><br>

        <label for="startdatum">Startdatum:</label>
        <input type="date" id="startdatum" name="startdatum" required min="<?= date('Y-m-d'); ?>" value="<?= isset($verkiezingsdatumStart) ? $verkiezingsdatumStart : ''; ?>"/><br>

        <label for="einddatum">Einddatum:</label>
        <input type="date" id="einddatum" name="einddatum" required min="<?= date('Y-m-d'); ?>" value="<?= isset($verkiezingsdatumEind) ? $verkiezingsdatumEind : ''; ?>"/><br>

        <label for="type">Verkiezingstype:</label>
        <?= $verkiezingen->Dropdown_VerkiezingType(isset($verkiezingstypeId) ? $verkiezingstypeId : null); ?>


        <input type='submit' name='insert' value='Toevoegen'>
    </form>
</body>
</html>
