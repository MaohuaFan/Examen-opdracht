<?php
// Auteur: Maohua Fan
// Functie: Publiceer verkiezingsuitslagen

session_start();

require_once '../../vendor/autoload.php';

use Examenopdracht\classes\Verkiezing;

// Controleer of de gebruiker een medewerker is
// if (!isset($_SESSION['is_medewerker']) || $_SESSION['is_medewerker'] !== true) {
//     echo "Je moet ingelogd zijn als medewerker om deze actie uit te voeren.";
//     exit;
// }

// Haal de Verkiezing_ID op van de URL of POST
if (isset($_POST['verkiezing_id'])) {
    $verkiezingId = $_POST['verkiezing_id'];

    // Maak een instantie van Verkiezing
    $verkiezing = new Verkiezing("","","","",0);

    // Publiceer de uitslag
    if ($verkiezing->publiceerUitslag($verkiezingId)) {
        header("Location: ../index.php?message=Uitslag succesvol gepubliceerd!");
        exit;
    } else {
        echo "<p style='color: red;'>Fout bij het publiceren van de uitslag.</p>";
    }
}
?>
