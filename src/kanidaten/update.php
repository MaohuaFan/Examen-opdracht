<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Haal de gegevens van de kandidaat op
    $sql = "SELECT * FROM kandidaten WHERE Kandidaat_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $kandidaat = $stmt->fetch();


}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kandidaatNaam = $_POST['Kandidaat_Naam'];
    $partijID = 1;
    $id = $_POST['Kandidaat_ID'];

    // Update de gegevens van de kandidaat
    $sql = "UPDATE kandidaten SET Kandidaat_Naam = :naam, Partij_ID = :partij WHERE Kandidaat_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':naam' => $kandidaatNaam, ':partij' => $partijID, ':id' => $id]);

    // Doorverwijzen naar de overzichtspagina na succesvolle update
    header('Location: read.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaat Bewerken</title>
</head>
<body>
    <h2>Kandidaat Bewerken</h2>

    <form action="update.php?id=<?php echo $kandidaat['Kandidaat_ID']; ?>" method="POST">
        <input type="hidden" name="Kandidaat_ID" value="<?php echo $kandidaat['Kandidaat_ID']; ?>">
        
        <label for="Kandidaat_Naam">Kandidaat Naam:</label>
        <input type="text" name="Kandidaat_Naam" value="<?php echo $kandidaat['Kandidaat_Naam']; ?>" required><br>

       
        </select><br><br>

        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="read.php">Terug naar overzicht</a>
</body>
</html>
