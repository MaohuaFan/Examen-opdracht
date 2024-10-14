<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Stemgerechtigde

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Stemgerechtigde extends Database {
    // Attributes
    protected $identificatienummer;
    protected $naam;
    protected $adres;
    protected $geboortedatum;
    protected $verkiezingId;

    // Constructor
    public function __construct($identificatienummer, $naam, $adres, $geboortedatum, $verkiezingId) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->identificatienummer = $identificatienummer;
        $this->naam = $naam;
        $this->adres = $adres;
        $this->geboortedatum = $geboortedatum;
        $this->verkiezingId = $verkiezingId;
    }

    // Methode om een stemgerechtigde te registreren
    public function registreerStemgerechtigde() {
        $query = "INSERT INTO stemgerechtigden (identificatienummer, naam, adres, geboortedatum, verkiezing_id) VALUES (?, ?, ?, ?, ?)";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([$this->identificatienummer, $this->naam, $this->adres, $this->geboortedatum, $this->verkiezingId]);

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
}
?>
