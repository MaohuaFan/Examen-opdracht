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

// Controleer of er een ID is meegegeven om een partij te bewerken
if (isset($_GET['id'])) {
    $partij_id = $_GET['id'];

    // Haal de partijgegevens op
    $sql = "SELECT id, partijnaam FROM partijen WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $partij_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $partij = $result->fetch_assoc();

    if (!$partij) {
        echo "Partij niet gevonden.";
        exit;
    }
} else {
    echo "Geen partij geselecteerd.";
    exit;
}

// Bewerken van de partij
if (isset($_POST["submit"])) {
    $partijnaam = $_POST['naam'];

    // Update query om de partijnaam bij te werken
    $sqlUpdate = "UPDATE partijen SET partijnaam = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $partijnaam, $partij_id);

    if ($stmtUpdate->execute()) {
        echo "Partij succesvol bijgewerkt!";
    } else {
        echo "Er is een fout opgetreden bij het bijwerken van de partij.";
    }

    // Sluit de statement en de verbinding
    $stmtUpdate->close();
    $conn->close();

    // Redirect naar de lijstpagina na het bijwerken
    header("Location: read.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Partij Bewerken</title>
</head>
<body>
    <h1>Partij Bewerken</h1>
    <form method="POST" action="">
        <label for="naam">Naam van de partij:</label>
        <input type="text" id="naam" name="naam" required value="<?php echo isset($partij['partijnaam']) ? htmlspecialchars($partij['partijnaam']) : ''; ?>">
        <input type="submit" name="submit" value="Bijwerken">
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
