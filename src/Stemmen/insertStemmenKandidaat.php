<?php
session_start();
require_once '../../vendor/autoload.php';
use Examenopdracht\classes\Kandidaat;
use Examenopdracht\classes\Stem;

// Controleer of de gebruiker is ingelogd en een verkiezing is gekozen
if (!isset($_SESSION['user_id']) || !isset($_POST['verkiezing_id'])) {
    echo "Je moet ingelogd zijn en een verkiezing hebben gekozen.";
    exit;
}

$verkiezingId = $_POST['verkiezing_id'];
$stemgerechtigdeId = $_SESSION['user_id'];

// Haal de kandidaten op voor de geselecteerde verkiezing
$kandidaten = new Kandidaat("", "", "","", 0);
$kandidatenLijst = $kandidaten->getKandidatenVoorVerkiezing($verkiezingId);

if (isset($_POST['insert']) && $_POST['insert'] == "Stem Uitbrengen") {
    $kandidaatId = $_POST['kandidaat_id'];

    // Maak een instantie van Stem
    $stem = new Stem($stemgerechtigdeId, $kandidaatId, $verkiezingId);

    // Controleer of de stemgerechtigde al heeft gestemd
    if ($stem->heeftAlGestemd($stemgerechtigdeId, $verkiezingId)) {
        echo "<p style='color: red;'>Je hebt al een stem uitgebracht voor deze verkiezing.</p>";
    } else {
        // Roep de registreerStem-methode aan
        $insertedId = $stem->registreerStem();

        if ($insertedId !== false) {
            // Succesvol: terug naar homepage
            echo "<p style='color: green;'>Stem succesvol uitgebracht!</p>";
        } else {
            echo "<p style='color: red;'>Fout bij het uitbrengen van de stem.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecteer Kandidaat</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <?php include '../nav.php'; ?>
    </header>
    <h1>Selecteer een Kandidaat</h1>
    <form action="" method="post">
        <input type="hidden" name="verkiezing_id" value="<?= htmlspecialchars($verkiezingId); ?>">
        <input type="hidden" name="stemgerechtigde_id" value="<?= htmlspecialchars($stemgerechtigdeId); ?>">

        <label for="kandidaat_id">Kandidaat:</label>
        <select name="kandidaat_id" id="kandidaat_id" required>
            <option value="">Selecteer een kandidaat</option>
            <?php foreach ($kandidatenLijst as $kandidaat): ?>
                <option value="<?= htmlspecialchars($kandidaat['Kandidaat_ID']); ?>">
                    <?= htmlspecialchars($kandidaat['PartijNaam'] . ' - ' . $kandidaat['KandidaatNaam']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="insert" value="Stem Uitbrengen">
    </form>
</body>
</html>
