<?php
include 'db.php'; // Verbind met de database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $partij_id = $_POST['partij_id'];

    $sql = "INSERT INTO verkiesbaren (naam, gecreëerd_op) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $naam);

    if ($stmt->execute()) {
        $verkiesbare_id = $stmt->insert_id;

        // Koppel de kandidaat aan de partij
        $sqlPartij = "INSERT INTO verkiesbaren_partijen (verkiesbare_id, partij_id) VALUES (?, ?)";
        $stmtPartij = $conn->prepare($sqlPartij);
        $stmtPartij->bind_param("ii", $verkiesbare_id, $partij_id);
        $stmtPartij->execute();
        
        echo "Kandidaat succesvol toegevoegd!";
    } else {
        echo "Er is een fout opgetreden: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: read.php");
    exit();
}
?>
