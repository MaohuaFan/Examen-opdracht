<?php
// auteur: studentnaam
// functie: connectie met de database

class Database {
    protected static $conn;

    public function __construct() {
        // Maak verbinding met de database
        $this->connect();
    }

    private function connect() {
        $host = 'localhost';
        $dbname = 'examenopdracht';  // Vervang dit door jouw database naam
        $username = 'root';  // Meestal is dit 'root' voor XAMPP
        $password = '';  // Leeg wachtwoord voor XAMPP

        try {
            self::$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
    }
}
