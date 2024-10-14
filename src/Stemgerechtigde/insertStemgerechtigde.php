<?php
// Auteur: Maohua Fan
// Functie: Insert class Stemgerechtigde

require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Stemgerechtigde;
use Examenopdracht\classes\Verkiezing;

$verkiezingen = new Verkiezing("", "", "", 0); // Je kunt de parameters hier negeren omdat we ze later instellen

// Verkrijg de verkiezing
$verkiezing = $verkiezingen->getVerkiezing();

if (isset($_POST["insert"]) && $_POST["insert"] == "Registreren") {
    $identificatienummer = $_POST['identificatienummer'];
    $naam = $_POST['naam'];
    $adres = $_POST['adres'];
    $geboortedatum = $_POST['geboortedatum'];
    $verkiezingId = $_POST['verkiezing_id'];

    // Maak een instantie van Stemgerechtigde
    $stemgerechtigde = new Stemgerechtigde($identificatienummer, $naam, $adres, $geboortedatum, $verkiezingId);

    // Roep de registreer-methode aan
    $insertedId = $stemgerechtigde->registreerStemgerechtigde();

    if ($insertedId !== false) {
        echo "Stemgerechtigde geregistreerd! ID is: $insertedId";
    } else {
        echo "Fout bij registratie.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer Stemgerechtigde</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Registreer Stemgerechtigde</h1>
    <form method="post">
        <label for="identificatienummer">Identificatienummer:</label>
        <input type="text" id="identificatienummer" name="identificatienummer" required/><br>

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required/><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres"/><br>

        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" required/><br>

        <label for="verkiezing_id">Verkiezing ID:</label>
        <?= $verkiezingen->Dropdown_Verkiezing(isset($verkiezingId) ? $verkiezingId : null); ?>

        <input type="submit" name="insert" value="Registreren">
    </form>
</body>
</html>
