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

    public function publiceerUitslag($verkiezingId) {
        $query = "UPDATE verkiezingen SET is_gepubliceerd = 1 WHERE Verkiezing_ID = :verkiezing_id";
        
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':verkiezing_id', $verkiezingId);
        
        return $stmt->execute();
    }
    

    public function getAantalUitgebrachteStemmen($verkiezingId, $stad) {
        $query = "SELECT COUNT(*) as aantal_uitgebrachte_stemmen 
                  FROM stemmen 
                  JOIN stemgerechtigden ON stemmen.Stemgerechtigde_ID = stemgerechtigden.Stemgerechtigde_ID 
                  WHERE Verkiezing_ID = :verkiezing_id AND stemgerechtigden.Stad = :stad";
        
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':verkiezing_id', $verkiezingId);
        $stmt->bindParam(':stad', $stad);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function getTotaalStemgerechtigden($stad, $verkiezingId) {
        $query = "SELECT COUNT(*) as totaal_stemgerechtigden 
                  FROM stemgerechtigden 
                  JOIN stemmen ON stemgerechtigden.Stemgerechtigde_ID = stemmen.Stemgerechtigde_ID 
                  WHERE stemgerechtigden.Stad = :stad 
                  AND stemmen.Verkiezing_ID = :verkiezing_id";
        
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindParam(':stad', $stad);
        $stmt->bindParam(':verkiezing_id', $verkiezingId);
        $stmt->execute();
    
        return $stmt->fetchColumn();
    }
    

    public function getOpkomstPercentage($stad, $verkiezingId) {
        // Haal het aantal uitgebrachte stemmen op voor de opgegeven stad en verkiezing
        $aantalStemmen = $this->getAantalUitgebrachteStemmen($verkiezingId, $stad);
        
        // Haal het totaal aantal stemgerechtigden op voor de opgegeven stad en verkiezing
        $totaalStemgerechtigden = $this->getTotaalStemgerechtigden($stad, $verkiezingId);
        
        // Bereken het opkomstpercentage
        $opkomstpercentage = $totaalStemgerechtigden > 0 ? ($aantalStemmen / $totaalStemgerechtigden) * 100 : 0;
    
        return [
            'aantal_uitgebrachte_stemmen' => $aantalStemmen,
            'totaal_stemgerechtigden' => $totaalStemgerechtigden,
            'opkomstpercentage' => $opkomstpercentage
        ];
    }
    


    public function getAlleSteden() {
        $query = "SELECT DISTINCT Stad FROM stemgerechtigden";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function getAlleVerkiezingen() {
    $query = "SELECT Verkiezing_ID, Naam as Verkiezing_Naam, is_gepubliceerd FROM verkiezingen";
    
    try {
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}


    public function getActieveVerkiezingen() {
        // Query om actieve verkiezingen samen met hun verkiezingstype op te halen
        $query = "SELECT verkiezingen.Naam, verkiezingen.Startdatum, verkiezingen.Einddatum, verkiezingtypes.Verkiezingtype_Naam, Verkiezingen.Verkiezing_ID
                FROM verkiezingen
                JOIN verkiezingtypes ON verkiezingen.Verkiezingtype_ID = verkiezingtypes.Verkiezingtype_ID
                WHERE :huidigeDatum BETWEEN verkiezingen.Startdatum AND verkiezingen.Einddatum AND verkiezingen.is_gepubliceerd = 0";
                
        $huidigeDatum = date('Y-m-d');
        
        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindParam(':huidigeDatum', $huidigeDatum);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
}
?>
