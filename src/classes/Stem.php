<?php
namespace Examenopdracht\classes;

use PDO;
use PDOException;

class Stem extends Database {
    // Attributes
    protected $stemgerechtigdeId;
    protected $kandidaatId;
    protected $verkiezingId;

    // Constructor
    public function __construct($stemgerechtigdeId = null, $kandidaatId = null, $verkiezingId = null) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->stemgerechtigdeId = $stemgerechtigdeId;
        $this->kandidaatId = $kandidaatId;
        $this->verkiezingId = $verkiezingId;
    }

    // Methode om een stem in te voegen
    public function registreerStem() {
        $query = "INSERT INTO stemmen (Stemgerechtigde_ID, Kandidaat_ID, Verkiezing_ID) VALUES (:stemgerechtigdeId, :kandidaatId, :verkiezingId)";
        
        try {
            $stmt = $this->getConnection()->prepare($query); // Zorg ervoor dat deze methode bestaat in Database
            $stmt->bindParam(':stemgerechtigdeId', $this->stemgerechtigdeId);
            $stmt->bindParam(':kandidaatId', $this->kandidaatId);
            $stmt->bindParam(':verkiezingId', $this->verkiezingId);
            $stmt->execute();

            return $this->getConnection()->lastInsertId(); // Retourneert het ID van de laatst toegevoegde stem
        } catch (PDOException $e) {
            return "Fout bij registratie van stem: " . $e->getMessage();
        }
    }


    public function heeftAlGestemd() {
        // Controleer of er al een stem is geregistreerd voor de huidige stemgerechtigde en verkiezing
        $query = "SELECT * FROM stemmen WHERE Stemgerechtigde_ID = :stemgerechtigdeId AND Verkiezing_ID = :verkiezingId";
        
        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindParam(':stemgerechtigdeId', $this->stemgerechtigdeId);
            $stmt->bindParam(':verkiezingId', $this->verkiezingId);
            $stmt->execute();
    
            return $stmt->rowCount() > 0; // Retourneer true als er al een stem is
        } catch (PDOException $e) {
            // Hier kun je beslissen hoe je wilt omgaan met fouten, bijvoorbeeld door een logbericht te schrijven
            return false; // Of throw new Exception("Error: " . $e->getMessage());
        }
    }
    
}
?>
