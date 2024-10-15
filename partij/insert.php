<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; 

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal verkiezingstypes op voor de dropdown
$verkiezingstypesSql = "SELECT VerkiezingType_ID, VerkiezingType_Naam FROM verkiezingtypes";
$verkiezingstypesResult = $conn->query($verkiezingstypesSql);

// Toevoegen van een nieuwe partij
if (isset($_POST["submit"])) {
    $partijnaam = $_POST['naam'];
    $verkiezingstype_id = $_POST['verkiezingstype']; // Get selected verkiezingstype

    // SQL-query om een nieuwe partij toe te voegen
    $sql = "INSERT INTO partijen (Partij_Naam) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $partijnaam);

    if ($stmt->execute()) {
        // Link de partij aan het verkiezingstype (optioneel, afhankelijk van je datamodel)
        $last_id = $conn->insert_id; // Get last inserted ID for partij
        $linkSql = "INSERT INTO verkiezingen_partijen (VerkiezingType_ID, Partij_ID) VALUES (?, ?)";
        $linkStmt = $conn->prepare($linkSql);
        $linkStmt->bind_param("ii", $verkiezingstype_id, $last_id);
        $linkStmt->execute();
        $linkStmt->close();

        echo "Partij succesvol toegevoegd!";
    } else {
        echo "Er is een fout opgetreden bij het toevoegen van de partij.";
    }

    // Sluit de statement en de verbinding
    $stmt->close();
    $conn->close();

    // Redirect naar de lijstpagina
    header("Location: read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Partij Toevoegen</title>
</head>
<body>
    <h1>Nieuwe Partij Toevoegen</h1>
    <form method="POST" action="">
        <label for="naam">Naam van de partij:</label>
        <input type="text" id="naam" name="naam" required>

        <label for="verkiezingstype">Verkiezingstype:</label>
        <select id="verkiezingstype" name="verkiezingstype" required>
            <?php
            if ($verkiezingstypesResult->num_rows > 0) {
                while ($row = $verkiezingstypesResult->fetch_assoc()) {
                    echo "<option value='" . $row['VerkiezingType_ID'] . "'>" . htmlspecialchars($row['VerkiezingType_Naam']) . "</option>";
                }
            } else {
                echo "<option value=''>Geen verkiezingstypes beschikbaar</option>";
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Toevoegen">
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
