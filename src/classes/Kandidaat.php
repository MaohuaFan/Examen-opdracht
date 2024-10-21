<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Kandidaat

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Kandidaat extends Database {
    // Attributes
    protected $kandidaatId;
    protected $kandidaatNaam;
    protected $partijId;
    protected $verkiesbaar; // Boolean

    // Constructor
    public function __construct($kandidaatId = null, $kandidaatNaam = null, $partijId = null, $verkiesbaar = null) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->kandidaatId = $kandidaatId;
        $this->kandidaatNaam = $kandidaatNaam;
        $this->partijId = $partijId;
        $this->verkiesbaar = $verkiesbaar; // Moet een boolean zijn (0 of 1)
    }

    // Methode om alle kandidaten op te halen
    public function getKandidaten() {
        $query = "SELECT Kandidaat_ID, Kandidaat_Naam, Partij_ID, Verkiesbaar FROM kandidaten"; // SQL-query om kandidaten op te halen

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneert een array van kandidaten
        } catch (PDOException $e) {
            return "Fout bij ophalen van kandidaten: " . $e->getMessage();
        }
    }

    // Methode om een dropdown van kandidaten te genereren
    public function Dropdown_Kandidaat($selectedId = null) {
        // Haal kandidaten op
        $kandidaten = $this->getKandidaten();
        
        // Begin met het genereren van de HTML voor de dropdown
        $html = '<select id="kandidaat_id" name="kandidaat_id" required>';
        $html .= '<option value="" disabled ' . (is_null($selectedId) ? 'selected' : '') . '>Kies een kandidaat</option>';
        
        // Controleer of er kandidaten zijn
        if (!empty($kandidaten)) {
            foreach ($kandidaten as $kand) {
                // Controleer of de kandidaat verkiesbaar is (0 of 1)
                if (isset($kand['Verkiesbaar']) && $kand['Verkiesbaar'] == 1) {
                    $isSelected = ($selectedId == $kand['Kandidaat_ID']) ? 'selected' : '';
                    $html .= '<option value="' . htmlspecialchars($kand['Kandidaat_ID']) . '" ' . $isSelected . '>';
                    $html .= htmlspecialchars($kand['Kandidaat_Naam']);
                    $html .= '</option>';
                }
            }
        } else {
            $html .= '<option value="">Geen kandidaten beschikbaar</option>';
        }

        $html .= '</select><br>';

        // Retourneer de HTML voor de dropdown
        return $html;
    }

    public function getKandidatenVoorVerkiezing($verkiezingId) {
        $query = "SELECT kandidaten.Kandidaat_ID, kandidaten.Kandidaat_Naam as KandidaatNaam, partijen.Partij_Naam as PartijNaam
                  FROM kandidaten
                  JOIN partijen ON kandidaten.Partij_ID = partijen.Partij_ID
				  WHERE kandidaten.Verkiesbaar = 1";
        
        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneer alle kandidaten met partijinformatie
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>
