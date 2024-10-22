<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Stemgerechtigde

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Stemgerechtigde extends Database {
    // Attributes
    protected $bsnNummer;
    protected $email; // Voeg de email toe
    protected $naam;
    protected $wachtwoord;
    protected $adres;
    protected $geboortedatum;

    // Constructor
    public function __construct($bsnNummer, $email, $naam, $wachtwoord, $adres, $geboortedatum) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->bsnNummer = $bsnNummer;
        $this->email = $email; // Correcte toewijzing van email
        $this->naam = $naam;
        $this->wachtwoord = $wachtwoord; // Bewaar het wachtwoord als gewone tekst
        $this->adres = $adres;
        $this->geboortedatum = $geboortedatum;
    }

    // Methode om een stemgerechtigde te registreren
    public function registreerStemgerechtigde() {
        $query = "INSERT INTO stemgerechtigden (bsn_nummer, email, naam, wachtwoord, adres, geboortedatum) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([$this->bsnNummer, $this->email, $this->naam, $this->wachtwoord, $this->adres, $this->geboortedatum]);

            return $this->getConnection()->lastInsertId(); // Retourneert het ID van de geregistreerde stemgerechtigde
        } catch (PDOException $e) {
            return "Fout bij registratie van stemgerechtigde: " . $e->getMessage();
        }
    }

    // Statische methode om alle stemgerechtigden op te halen
    public static function getStemgerechtigden() {
        $db = new Database(); // Maak verbinding met de database
        $connection = $db->getConnection(); // Verkrijg de databaseverbinding

        $query = "SELECT * FROM stemgerechtigden"; // SQL-query om stemgerechtigden op te halen

        try {
            $stmt = $connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneert een array van stemgerechtigden
        } catch (PDOException $e) {
            return "Fout bij ophalen van stemgerechtigden: " . $e->getMessage();
        }
    }

    // Methode om te controleren of een BSN-nummer al bestaat
    public static function exists($bsnNummer) {
        $db = new Database();
        $connection = $db->getConnection();

        $query = "SELECT COUNT(*) FROM stemgerechtigden WHERE bsn_nummer = ?";
        try {
            $stmt = $connection->prepare($query);
            $stmt->execute([$bsnNummer]);
            return $stmt->fetchColumn() > 0; // Retourneert true als het BSN-nummer bestaat
        } catch (PDOException $e) {
            return "Fout bij het controleren van BSN-nummer: " . $e->getMessage();
        }
    }

    public function Dropdown_Stemgerechtigde($selectedId = null) {
    // Haal stemgerechtigden op
    $stemgerechtigden = $this->getStemgerechtigden(); // Deze methode moet je definiëren om stemgerechtigden op te halen
    
    // Begin met het genereren van de HTML voor de dropdown
    $html = '<select id="stemgerechtigde_id" name="stemgerechtigde_id" required>';
    $html .= '<option value="" disabled ' . (is_null($selectedId) ? 'selected' : '') . '>Kies een stemgerechtigde</option>';
    
    // Controleer of er stemgerechtigden zijn
    if (!empty($stemgerechtigden)) {
        foreach ($stemgerechtigden as $stemgerechtigde) {
            $isSelected = ($selectedId == $stemgerechtigde['Stemgerechtigde_ID']) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($stemgerechtigde['Stemgerechtigde_ID']) . '" ' . $isSelected . '>';
            $html .= htmlspecialchars($stemgerechtigde['Naam']);
            $html .= '</option>';
        }
    } else {
        $html .= '<option value="">Geen stemgerechtigden beschikbaar</option>';
    }
    
    $html .= '</select><br>';
    
    return $html;
}



}
?>
