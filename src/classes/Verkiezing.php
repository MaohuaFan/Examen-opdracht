<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Verkiezing

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Verkiezing extends Database {
    // Attributes
    protected $naam;
    protected $startdatum;
    protected $einddatum;
    protected $verkiezingTypeId;

    // Constructor
    public function __construct($naam, $startdatum, $einddatum, $type) {
        parent::__construct();
        $this->naam = $naam;
        $this->startdatum = $startdatum;
        $this->einddatum = $einddatum;
        $this->verkiezingTypeId = $type;
    }
    
    

    // Method voor registratie van een verkiezing
    public function registreerVerkiezing() {
        // Bereid de SQL-query voor
        $query = "INSERT INTO verkiezingen (verkiezingType_ID, Naam, Startdatum, Einddatum) VALUES (?, ?, ?, ?)";

        try {
            // Verkrijg de databaseverbinding
            $stmt = $this->getConnection()->prepare($query);

            // Voer de query uit met de eigenschappen
            $stmt->execute([$this->verkiezingTypeId, $this->naam, $this->startdatum, $this->einddatum]);

            // Retourneer het ID van de nieuwe verkiezing
            return $this->getConnection()->lastInsertId();
        } catch (PDOException $e) {
            // Foutafhandeling
            return "Fout bij registratie van verkiezing: " . $e->getMessage();
        }
    }



    public function getVerkiezingTypes() {
        // Bereid de SQL-query voor om alle verkiezingstypes op te halen
        $query = "SELECT VerkiezingType_ID, VerkiezingType_Naam FROM verkiezingtypes";
    
        try {
            // Verkrijg de databaseverbinding
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
    
            // Haal de resultaten op en retourneer als een array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Foutafhandeling
            return "Fout bij ophalen van verkiezingstypes: " . $e->getMessage();
        }
    }    


    public function Dropdown_VerkiezingType($selectedId = null) {
        // Haal verkiezingstypes op
        $verkiezingTypes = $this->getVerkiezingTypes();
        
        // Begin met het genereren van de HTML voor de dropdown
        $html = '<select id="type" name="type" required>';
        $html .= '<option value="" disabled ' . (is_null($selectedId) ? 'selected' : '') . '>Kies een verkiezingstype</option>';
        
        // Loop door de verkiezingstypes en voeg opties toe
        foreach ($verkiezingTypes as $type) {
            $isSelected = ($selectedId == $type['VerkiezingType_ID']) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($type['VerkiezingType_ID']) . '" ' . $isSelected . '>';
            $html .= htmlspecialchars($type['VerkiezingType_Naam']);
            $html .= '</option>';
        }
        
        $html .= '</select><br>';
    
        // Retourneer de HTML voor de dropdown
        return $html;
    }
    




    public function getVerkiezing() {
        // Bereid de SQL-query voor om alle verkiezingen op te halen
        $query = "SELECT Verkiezing_ID, Naam FROM verkiezingen"; // corrigeer de tabelnaam hier als nodig
        
        try {
            // Verkrijg de databaseverbinding
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
    
            // Haal de resultaten op en retourneer als een array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Foutafhandeling: retourneer een lege array bij een fout
            return [];
        }
    }

    // In Verkiezing.php
    public function getActieveVerkiezingen() {
        $query = "SELECT * FROM verkiezingen WHERE :huidigeDatum BETWEEN Startdatum AND Einddatum";
        $huidigeDatum = date('Y-m-d');
        
        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindParam(':huidigeDatum', $huidigeDatum);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourneer alle actieve verkiezingen
        } catch (PDOException $e) {
            return [];
        }
    }


    // public function Dropdown_Verkiezing($selectedId = null) {
    //     // Haal verkiezingen op
    //     $verkiezingen = $this->getVerkiezing();
        
    //     // Begin met het genereren van de HTML voor de dropdown
    //     $html = '<select id="verkiezing_id" name="verkiezing_id" required>';
    //     $html .= '<option value="" disabled ' . (is_null($selectedId) ? 'selected' : '') . '>Kies een verkiezing</option>';
        
    //     // Controleer of er verkiezingen zijn
    //     if (!empty($verkiezingen)) {
    //         // Loop door de verkiezingen en voeg opties toe
    //         foreach ($verkiezingen as $verk) {
    //             $isSelected = ($selectedId == $verk['Verkiezing_ID']) ? 'selected' : '';
    //             $html .= '<option value="' . htmlspecialchars($verk['Verkiezing_ID']) . '" ' . $isSelected . '>';
    //             $html .= htmlspecialchars($verk['Naam']);
    //             $html .= '</option>';
    //         }
    //     } else {
    //         // Voeg een optie toe als er geen verkiezingen zijn
    //         $html .= '<option value="">Geen verkiezingen beschikbaar</option>';
    //     }
    
    //     $html .= '</select><br>';
    
    //     // Retourneer de HTML voor de dropdown
    //     return $html;
    // }
    
}
?>
