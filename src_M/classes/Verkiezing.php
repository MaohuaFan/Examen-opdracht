<?php
    // Auteur: Maohua Fan
    // Functie: Definitie Class Verkiezing
    namespace Examenopdracht\classes;

    use Examenopdracht\classes\Database;

    include_once "functions.php";

    class Verkiezing extends Database{
        // Attributes
        protected $naam;
        protected $datum;
        protected $type;

        // Constructor
        public function __construct($naam, $datum, $type) {
            $this->naam = $naam;
            $this->datum = $datum;
            $this->type = $type;
        }

        // Method
        
        // Een verkiezing te registreren
        public function registreerVerkiezing() {
            // Bereid de SQL-query voor
            $query = "INSERT INTO verkiezingen (verkiezingsnaam, verkiezingsdatum, verkiezingstype_id) VALUES (?, ?, ?)";
            
            try {
                // Verkrijg de databaseverbinding
                $stmt = $this->getConnection()->prepare($query);

                // Voer de query uit met de eigenschappen
                $stmt->execute([$this->naam, $this->datum, $this->type]);

                // Teruggeven van succes of bevestiging
                return "Verkiezing succesvol geregistreerd!";
            } catch (PDOException $e) {
                // Foutafhandeling
                return "Fout bij registratie van verkiezing: " . $e->getMessage();
            }
        }

            
    }
?>