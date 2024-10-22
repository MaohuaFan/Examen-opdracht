<?php
session_start();
require_once '../../vendor/autoload.php';
use Examenopdracht\classes\Verkiezing;

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    echo "Je moet ingelogd zijn om een verkiezing te selecteren.";
    exit;
}

// Verkrijg de actieve verkiezingen, inclusief verkiezingstype
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

    <table border="1">
        <thead>
            <tr>
                <th>Verkiezing</th>
                <th>Verkiezingstype</th> <!-- Toegevoegd: Verkiezingstype -->
                <th>Startdatum</th>
                <th>Einddatum</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actieveVerkiezingen as $verkiezing): ?>
            <tr>
                <td><?= htmlspecialchars($verkiezing['Naam']); ?></td>
                <td><?= htmlspecialchars($verkiezing['Verkiezingtype_Naam']); ?></td>
                <td><?= htmlspecialchars($verkiezing['Startdatum']); ?></td>
                <td><?= htmlspecialchars($verkiezing['Einddatum']); ?></td>
                <td>
                    <form action="insertStemmenKandidaat.php" method="post">
                        <input type="hidden" name="verkiezing_id" value="<?= htmlspecialchars($verkiezing['Verkiezing_ID']); ?>">
                        <input type="submit" value="Stem">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
