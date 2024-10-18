<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Stem

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Stem {
    protected $stemgerechtigdeId;
    protected $kandidaatId;
    protected $verkiezingId;

    public function __construct($stemgerechtigdeId, $kandidaatId, $verkiezingId) {
        $this->stemgerechtigdeId = $stemgerechtigdeId;
        $this->kandidaatId = $kandidaatId;
        $this->verkiezingId = $verkiezingId;
    }

    // Methode om de stem in te voeren
    public function registreerStem() {
        $query = "INSERT INTO stemmen (stemgerechtigde_id, kandidaat_id, verkiezing_id) VALUES (?, ?, ?)";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([$this->stemgerechtigdeId, $this->kandidaatId, $this->verkiezingId]);

            return $this->getConnection()->lastInsertId(); // Retourneert het ID van de geregistreerde stem
        } catch (PDOException $e) {
            return "Fout bij registratie van stem: " . $e->getMessage();
        }
    }
}

?>
