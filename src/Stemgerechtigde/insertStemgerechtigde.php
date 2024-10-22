<?php
// Auteur: Maohua Fan
// Functie: Insert class Stemgerechtigde

session_start();
require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Stemgerechtigde;

if (isset($_POST["insert"]) && $_POST["insert"] == "Registreren") {
    $bsnNummer = $_POST['bsnNummer'];
    $email = $_POST['email'];
    $naam = $_POST['naam'];
    $wachtwoord = $_POST['wachtwoord'];
    $Stad = $_POST['Stad'];
    $geboortedatum = $_POST['geboortedatum'];

    // Validatie van het BSN-nummer (moet 9 cijfers zijn)
    if (!preg_match('/^\d{9}$/', $bsnNummer)) {
        echo "Het BSN-nummer moet precies 9 cijfers bevatten.";
    } else {
        // Controleer of het BSN-nummer al bestaat
        if (Stemgerechtigde::exists($bsnNummer)) {
            echo "Fout: Dit BSN-nummer is al geregistreerd.";
        } else {
            // Maak een instantie van Stemgerechtigde
            $stemgerechtigde = new Stemgerechtigde($bsnNummer, $email, $naam, $wachtwoord, $Stad, $geboortedatum);

            // Roep de registreer-methode aan
            $insertedId = $stemgerechtigde->registreerStemgerechtigde();

            if ($insertedId !== false) {
                echo "Stemgerechtigde geregistreerd! ID is: $insertedId";
            } else {
                echo "Fout bij registratie.";
            }
        }
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
    <header>
        <?php 
            include '../nav.php'; // Include de navigatiebalk 
        ?>
    </header>
    <h1>Account Registreren</h1>
    <form method="post">
        <label for="bsnNummer">BSN-Nummer:</label>
        <input type="text" id="bsnNummer" name="bsnNummer" required/><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required/><br>

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required/><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required/><br>

        <label for="Stad">Stad:</label>
        <input type="text" id="Stad" name="Stad"/><br>

        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" id="geboortedatum" name="geboortedatum" required/><br>

        <input type="submit" name="insert" value="Registreren">
    </form>
</body>
</html>
