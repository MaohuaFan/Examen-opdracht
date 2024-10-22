<?php
session_start();
require_once '../../vendor/autoload.php';
use Examenopdracht\classes\Verkiezing;

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    echo "Je moet ingelogd zijn om een verkiezing te selecteren.";
    exit;
}

// Verkrijg de actieve verkiezingen
$verkiezingen = new Verkiezing("", "", "", 0);
$actieveVerkiezingen = $verkiezingen->getActieveVerkiezingen();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecteer Verkiezing</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <?php include '../nav.php'; ?>
    </header>
    <h1>Selecteer een Verkiezing</h1>
    <form action="insertStemmenKandidaat.php" method="post">
        <label for="verkiezing_id">Verkiezing:</label>
        <select name="verkiezing_id" id="verkiezing_id" required>
            <option value="">Selecteer een verkiezing</option>
            <?php foreach ($actieveVerkiezingen as $verkiezing): ?>
                <option value="<?= htmlspecialchars($verkiezing['Verkiezing_ID']); ?>">
                    <?= htmlspecialchars($verkiezing['Naam'] . ' (' . $verkiezing['Startdatum'] . ' - ' . $verkiezing['Einddatum'] . ')'); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ga Verder">
    </form>
</body>
</html>
