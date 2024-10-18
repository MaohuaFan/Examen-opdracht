<?php
// Auteur: Maohua Fan
// Functie: Insert class Stem

require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Stem;
use Examenopdracht\classes\Stemgerechtigde;
use Examenopdracht\classes\Kandidaat;
use Examenopdracht\classes\Verkiezing;

// Verkrijg de verkiezingen, stemgerechtigden en kandidaten
$verkiezingen = new Verkiezing("", "", "", 0);
$stemgerechtigden = new Stemgerechtigde("", "", "", "", "");
$kandidaten = new Kandidaat("", "", "", "", "");

if (isset($_POST["insert"]) && $_POST["insert"] == "Stem Uitbrengen") {
    $stemgerechtigdeId = $_POST['stemgerechtigde_id'];
    $kandidaatId = $_POST['kandidaat_id'];
    $verkiezingId = $_POST['verkiezing_id'];

    // Maak een instantie van Stem
    $stem = new Stem($stemgerechtigdeId, $kandidaatId, $verkiezingId);

    // Roep de registreerStem-methode aan
    $insertedId = $stem->registreerStem();

    if ($insertedId !== false) {
        echo "Stem succesvol uitgebracht! ID van de stem is: $insertedId";
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
    <h1>Stem Uitbrengen</h1>
    <form method="post">
        <label for="stemgerechtigde_id">Stemgerechtigde:</label>
        <?= $stemgerechtigden->Dropdown_Stemgerechtigde(); ?>

        <label for="kandidaat_id">Kandidaat:</label>
        <?= $kandidaten->Dropdown_Kandidaat(); ?>

        <label for="verkiezing_id">Verkiezing:</label>
        <?= $verkiezingen->Dropdown_Verkiezing(); ?>

        <input type="submit" name="insert" value="Stem Uitbrengen">
    </form>
</body>
</html>
