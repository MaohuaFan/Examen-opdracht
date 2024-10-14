<?php
// Auteur: Maohua Fan
// Functie: Insert class Stemmen

require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Verkiezing;
use Examenopdracht\classes\Stemgerechtigde;
// use Examenopdracht\classes\Kandidaat;
use Examenopdracht\classes\Stem;

$verkiezing = new Verkiezing("", "", "", 0);
$stemgerechtigde = new Stemgerechtigde("", "", "", "", 0);
// $kandidaat = new Kandidaat();

// Verkrijg de lijst van verkiezingen, stemgerechtigden en kandidaten
$verkiezingen = $verkiezing->getVerkiezing();
$stemgerechtigden = $stemgerechtigde->getStemgerechtigden(); // Schrijf een methode om alle stemgerechtigden op te halen
// $kandidaten = $kandidaat->getKandidaten(); // Schrijf een methode om alle kandidaten op te halen

if (isset($_POST["vote"]) && $_POST["vote"] == "Stem") {
    $verkiezingId = $_POST['verkiezing_id'];
    $stemgerechtigdeId = $_POST['stemgerechtigde_id'];
    $kandidaatId = $_POST['kandidaat_id'];

    // Maak een instantie van de Stem klasse
    $stem = new Stem($verkiezingId, $stemgerechtigdeId, $kandidaatId);

    // Roep de methode aan om de stem uit te brengen
    $insertedId = $stem->brengStemUit();

    if ($insertedId !== false) {
        echo "Stem uitgebracht! Stem ID is: $insertedId";
    } else {
        echo "Fout bij het uitbrengen van de stem.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stem Uitbrengen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Breng je stem uit</h1>
    <form method="post">
        <label for="verkiezing_id">Kies Verkiezing:</label>
        <select id="verkiezing_id" name="verkiezing_id" required>
            <option value="" disabled selected>Kies een verkiezing</option>
            <?php foreach ($verkiezingen as $verkiezing): ?>
                <option value="<?= $verkiezing['id']; ?>"><?= htmlspecialchars($verkiezing['naam']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="stemgerechtigde_id">Kies Stemgerechtigde:</label>
        <select id="stemgerechtigde_id" name="stemgerechtigde_id" required>
            <option value="" disabled selected>Kies een stemgerechtigde</option>
            <?php foreach ($stemgerechtigden as $gerechtigde): ?>
                <option value="<?= $gerechtigde['id']; ?>"><?= htmlspecialchars($gerechtigde['naam']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="kandidaat_id">Kies Kandidaat:</label>
        <select id="kandidaat_id" name="kandidaat_id" required>
            <option value="" disabled selected>Kies een kandidaat</option>
            <?php
            // Maak een instantie van de Stem klasse om kandidaten op te halen
            $stemInstance = new Stem($verkiezingId, null, null);
            $kandidaten = $stemInstance->getKandidaten();
            foreach ($kandidaten as $kandidaat): ?>
                <option value="<?= $kandidaat['id']; ?>"><?= htmlspecialchars($kandidaat['naam']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" name="vote" value="Stem">
    </form>
</body>
</html>