<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kandidaatNaam = $_POST['kandidaat_naam'];
    $partijID = 1;

    // SQL om een nieuwe kandidaat in te voegen
    $sql = "INSERT INTO kandidaten (Kandidaat_Naam, Partij_ID) VALUES (:kandidaat_naam, :partij_id)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['kandidaat_naam' => $kandidaatNaam, 'partij_id' => $partijID]);

    // Redirect terug naar de read.php pagina
    header("Location: read.php");
    exit;
}

// Haal alle partijen op om te selecteren in het formulier
$sqlPartijen = "SELECT * FROM partijen";
$stmt = $conn->query($sqlPartijen);
$partijen = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Kandidaat Toevoegen</title>
</head>
<body>
    <h2>Nieuwe Kandidaat Toevoegen</h2>

    <form method="POST" action="insert.php">
        <label for="kandidaat_naam">Kandidaat Naam:</label>
        <input type="text" name="kandidaat_naam" required><br><br>

      
        </select><br><br>

        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="read.php">Terug naar Overzicht</a>
</body>
</html>
