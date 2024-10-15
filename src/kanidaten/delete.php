<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM kandidaten WHERE Kandidaat_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Kandidaat succesvol verwijderd!";
    } else {
        echo "Er is een fout opgetreden.";
    }
}
?>

<!-- Link voor verwijderen -->
<a href="delete.php?id=<?php echo $candidate['Kandidaat_ID']; ?>">Verwijder Kandidaat</a>
