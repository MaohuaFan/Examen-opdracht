<?php
// Auteur: Maohua Fan
// Functie: Definitie Class Stem

namespace Examenopdracht\classes;

use PDO;
use PDOException;

include_once "Database.php";

class Stem extends Database {
    // Attributes
    protected $verkiezingId;
    protected $stemgerechtigdeId;
    protected $kandidaatId;

    // Constructor
    public function __construct($verkiezingId, $stemgerechtigdeId, $kandidaatId) {
        parent::__construct(); // Roept de constructor van de Database-klasse aan
        $this->verkiezingId = $verkiezingId;
        $this->stemgerechtigdeId = $stemgerechtigdeId;
        $this->kandidaatId = $kandidaatId;
    }

    // Methode om een stem uit te brengen
    public function brengStemUit() {
        $query = "INSERT INTO stemmen (verkiezing_id, stemgerechtigde_id, kandidaat_id) VALUES (?, ?, ?)";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([$this->verkiezingId, $this->stemgerechtigdeId, $this->kandidaatId]);

            return $this->getConnection()->lastInsertId(); // Retourneert het ID van de nieuwe stem
        } catch (PDOException $e) {
            return "Fout bij het uitbrengen van stem: " . $e->getMessage();
        }
    }
}





    // Methode om kandidaten op te halen
    public function getKandidaten() {
        // Hier definieer je hoe je kandidaten uit de database ophaalt
        // Voorbeeld:
        // return Database::query("SELECT * FROM kandidaten WHERE verkiezing_id = ?", [$this->verkiezingId]);
        // Dit is een placeholder; vervang het door je eigen database query
        return [
            ['id' => 1, 'naam' => 'Kandidaat 1'],
            ['id' => 2, 'naam' => 'Kandidaat 2'],
            ['id' => 3, 'naam' => 'Kandidaat 3'],
        ];
    }
?>
