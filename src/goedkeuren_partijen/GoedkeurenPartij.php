<?php
// src/goedkeuren_partijen/GoedkeurenPartij.php

require_once '../koppelen/db.php'; // Controleer of dit pad correct is

class GoedkeurenPartij {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function keurPartijGoed($partij_id, $opmerkingen) {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("UPDATE partijen SET Goedkeuring_Status = 'goedgekeurd' WHERE Partij_ID = :partij_id");
            $stmt->execute(['partij_id' => $partij_id]);

            $stmt = $this->pdo->prepare("INSERT INTO goedkeuring_historie (Partij_ID, Datum, Status, Opmerkingen) VALUES (:partij_id, NOW(), 'goedgekeurd', :opmerkingen)");
            $stmt->execute(['partij_id' => $partij_id, 'opmerkingen' => $opmerkingen]);

            $this->pdo->commit();
            return "De partij is goedgekeurd.";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Er is een fout opgetreden: " . $e->getMessage();
        }
    }

    public function keurPartijAf($partij_id, $opmerkingen) {
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("UPDATE partijen SET Goedkeuring_Status = 'afgewezen' WHERE Partij_ID = :partij_id");
            $stmt->execute(['partij_id' => $partij_id]);

            $stmt = $this->pdo->prepare("INSERT INTO goedkeuring_historie (Partij_ID, Datum, Status, Opmerkingen) VALUES (:partij_id, NOW(), 'afgewezen', :opmerkingen)");
            $stmt->execute(['partij_id' => $partij_id, 'opmerkingen' => $opmerkingen]);

            $this->pdo->commit();
            return "De partij is afgewezen.";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Er is een fout opgetreden: " . $e->getMessage();
        }
    }

    // Nieuwe functie om een lijst van partijen op te halen
    public function getPartijen() {
        $stmt = $this->pdo->query("SELECT Partij_ID, Partij_Naam, Goedkeuring_Status FROM partijen");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
