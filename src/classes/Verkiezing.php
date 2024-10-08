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
}
?>
