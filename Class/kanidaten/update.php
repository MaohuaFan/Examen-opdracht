<?php
include 'db.php'; // Verbind met de database

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $partij_id = $_POST['partij_id'];

    // Update kandidaat
    $sql = "UPDATE verkiesbaren SET naam = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $naam, $id);
    $stmt->execute();
    $stmt->close();

    // Update partij
    $sqlPartij = "UPDATE verkiesbaren_partijen SET partij_id = ? WHERE verkiesbare_id = ?";
    $stmtPartij = $conn->prepare($sqlPartij);
    $stmtPartij->bind_param("ii", $partij_id, $id);
    $stmtPartij->execute();
    
    echo "Kandidaat succesvol bijgewerkt!";
    
    $stmtPartij->close();
    $conn->close();
    header("Location: read.php");
    exit();
}
?>
