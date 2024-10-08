<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; // Nieuwe naam van je database

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if (isset($_POST["insert"])) {
    // Verzamelen van de formuliergegevens
    $naam = $_POST['naam'];
    $partij_id = $_POST['partij_id'];
    $verkiezing_id = $_POST['verkiezing_id'];
    $positie = $_POST['positie'];

    // Voeg de nieuwe kandidaat toe aan de 'verkiesbaren' tabel
    $sql = "INSERT INTO verkiesbaren (naam, gecreëerd_op) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $naam);
    
    if ($stmt->execute()) {
        // Verkiesbare ID ophalen
        $verkiesbare_id = $stmt->insert_id;

        // Voeg de kandidaat toe aan de 'verkiesbaren_partijen' tabel
        $sqlPartij = "INSERT INTO verkiesbaren_partijen (verkiesbare_id, partij_id, verkiezing_id, positie) VALUES (?, ?, ?, ?)";
        $stmtPartij = $conn->prepare($sqlPartij);
        $stmtPartij->bind_param("iiii", $verkiesbare_id, $partij_id, $verkiezing_id, $positie);

        if ($stmtPartij->execute()) {
            echo "Kandidaat succesvol toegevoegd!";
        } else {
            echo "Er is een fout opgetreden bij het koppelen van de partij en verkiezing.";
        }
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de kandidaat.";
    }

    // Sluit de verbinding
    $conn->close();
}
?>
