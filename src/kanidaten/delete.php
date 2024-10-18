<?php
include 'db.php';

if (isset($_POST['id'])) {
    $kandidaatID = $_POST['id'];

    // Verwijder de kandidaat uit de database
    $sql = "DELETE FROM kandidaten WHERE Kandidaat_ID = :id";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute(['id' => $kandidaatID])) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
