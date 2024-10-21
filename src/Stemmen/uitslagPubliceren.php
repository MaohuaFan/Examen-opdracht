<?php
session_start();

require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Verkiezing;

// Controleer of de gebruiker een medewerker is
// if (!isset($_SESSION['is_medewerker']) || $_SESSION['is_medewerker'] !== true) {
//     echo "Je moet ingelogd zijn als medewerker om deze pagina te bekijken.";
//     exit;
// }

$verkiezing = new Verkiezing("","","","",0);
$verkiezingen = $verkiezing->getAlleVerkiezingen(); // Haal alle verkiezingen op

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uitslag Publiceren</title>
</head>
<body>
    <h1>Verkiezingsuitslag Publiceren</h1>
    <form method="post" action="publiceerUitslag.php">
        <label for="verkiezing_id">Selecteer Verkiezing:</label>
        <select name="verkiezing_id" id="verkiezing_id">
            <?php foreach ($verkiezingen as $verkiezing) : ?>
                <option value="<?= $verkiezing['Verkiezing_ID']; ?>">
                    <?= htmlspecialchars($verkiezing['Verkiezing_Naam']); ?>
                    (Geplaatst: <?= $verkiezing['is_gepubliceerd'] ? 'Ja' : 'Nee'; ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Publiceer Uitslag">
    </form>
</body>
</html>
