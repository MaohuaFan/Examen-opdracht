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
$verkiezingstypesSql = "SELECT id, type FROM verkiezingstypes";
$verkiezingstypesResult = $conn->query($verkiezingstypesSql);

// Toevoegen van een nieuwe partij
if (isset($_POST["submit"])) {
    $partijnaam = $_POST['naam'];
    $verkiezingstype_id = $_POST['verkiezingstype']; // Verkiezingstype ID ophalen

    // SQL-query om een nieuwe partij toe te voegen
    $sql = "INSERT INTO partijen (partijnaam, gecreëerd_op) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $partijnaam);

    if ($stmt->execute()) {
        // Hier kun je ook een relatie toevoegen tussen de partij en het verkiezingstype, als dat nodig is.
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
        
        <label for="verkiezingstype">Kies een verkiezingstype:</label>
        <select id="verkiezingstype" name="verkiezingstype" required>
            <option value="">Selecteer een verkiezingstype</option>
            <?php
            // Vul de dropdown met verkiezingstypes
            if ($verkiezingstypesResult->num_rows > 0) {
                while ($row = $verkiezingstypesResult->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['type']) . "</option>";
                }
            } else {
                echo "<option value=''>Geen verkiezingstypes gevonden</option>";
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Toevoegen">
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
            