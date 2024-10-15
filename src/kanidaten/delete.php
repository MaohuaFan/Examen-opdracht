<?php
include 'db.php'; // Verbind met de database

$id = $_GET['id'];

// Verwijder de koppeling met de partij
$sqlPartij = "DELETE FROM verkiesbaren_partijen WHERE verkiesbare_id = ?";
$stmtPartij = $conn->prepare($sqlPartij);
$stmtPartij->bind_param("i", $id);
$stmtPartij->execute();
$stmtPartij->close();

// Verwijder de kandidaat
$sql = "DELETE FROM verkiesbaren WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Kandidaat succesvol verwijderd!";
} else {
    echo "Er is een fout opgetreden: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: read.php");
exit();
?>
