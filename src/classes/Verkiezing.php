<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Verkiezing

namespace Examenopdracht\classes;

// use Examenopdracht\classes\Database;
use PDO;
use PDOException;

include_once "Database.php";
include_once "functions.php";


class Verkiezing extends Database {
    // Attributes
    protected $naam;
    protected $startdatum;
    protected $einddatum;
    protected $verkiezingTypeId;

    // Constructor
    public function __construct($naam, $startdatum, $einddatum, $type) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->naam = $naam;
        $this->startdatum = $startdatum;
        $this->einddatum = $einddatum;
        $this->verkiezingTypeId = $type; // Zorg ervoor dat dit overeenkomt
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
            error_log("Fout bij registratie van verkiezing: " . $e->getMessage()); // Log fout voor ontwikkelaars
            return false; // Retourneer false zodat we foutmeldingen kunnen tonen
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
        
        $html .= '</select><br><br>';
    
        // Retourneer de HTML voor de dropdown
        return $html;
    }
    
}
?>
