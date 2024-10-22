<?php
session_start();
require_once '../../vendor/autoload.php';
use Examenopdracht\classes\Verkiezing;

// Controleer of de gebruiker een medewerker is
// if (!isset($_SESSION['is_medewerker']) || $_SESSION['is_medewerker'] !== true) {
//     echo "Je moet ingelogd zijn als medewerker om deze pagina te bekijken.";
//     exit;
// }

$verkiezing = new Verkiezing("", "", "", 0);

// Haal de steden op
$steden = $verkiezing->getAlleSteden();

if (isset($_POST['stad']) && isset($_POST['verkiezing_id'])) {
    $stad = $_POST['stad'];
    $verkiezingId = $_POST['verkiezing_id'];
    
    $opkomstInfo = $verkiezing->getOpkomstPercentage($stad, $verkiezingId);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opkomst Percentage</title>
</head>
<body>
    <h1>Opkomst Percentage Per Stad</h1>
    <form method="post" action="">
        <label for="stad">Selecteer Stad:</label>
        <select name="stad" id="stad" required>
            <option value="">Selecteer een stad</option>
            <?php foreach ($steden as $stad): ?>
                <option value="<?= htmlspecialchars($stad['Stad']); ?>">
                    <?= htmlspecialchars($stad['Stad']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="verkiezing_id">Selecteer Verkiezing:</label>
        <select name="verkiezing_id" id="verkiezing_id">
            <?php 
            $verkiezingen = $verkiezing->getAlleVerkiezingen();
            foreach ($verkiezingen as $verkiezing) : ?>
                <option value="<?= $verkiezing['Verkiezing_ID']; ?>">
                    <?= htmlspecialchars($verkiezing['Verkiezing_Naam']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Bekijk Opkomst">
    </form>

    <?php if (isset($opkomstInfo)) : ?>
        <h2>Opkomst voor <?= htmlspecialchars($stad); ?></h2>
        <p>Aantal uitgebrachte stemmen: <?= $opkomstInfo['aantal_uitgebrachte_stemmen']; ?></p>
        <p>Totaal aantal stemgerechtigden: <?= $opkomstInfo['totaal_stemgerechtigden']; ?></p>
        <p>Opkomstpercentage: <?= number_format($opkomstInfo['opkomstpercentage'], 2); ?>%</p>
    <?php endif; ?>
</body>
</html>
