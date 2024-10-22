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

if (isset($_GET['id'])) {
    $partij_id = $_GET['id'];

    // Haal de huidige partijgegevens op
    $sql = "SELECT * FROM partijen WHERE Partij_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $partij_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $partij = $result->fetch_assoc();

    if (isset($_POST["submit"])) {
        $partijnaam = $_POST['naam'];
        $partijvolgorde = $_POST['volgorde'];

        // Controleer of de nieuwe volgorde al bestaat, behalve voor de huidige partij
        $checkSql = "SELECT * FROM partijen WHERE Partij_Volgorde = ? AND Partij_ID != ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("ii", $partijvolgorde, $partij_id); // Bind volgorde en partij ID
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Als de volgorde al bestaat, geef een foutmelding
            echo "Er bestaat al een partij met dit volgordenummer. Kies een ander nummer.";
        } else {
            // Update de partij
            $sql = "UPDATE partijen SET Partij_Naam = ?, Partij_Volgorde = ? WHERE Partij_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $partijnaam, $partijvolgorde, $partij_id);

            if ($stmt->execute()) {
                echo "Partij succesvol bijgewerkt!";
            } else {
                echo "Er is een fout opgetreden bij het bijwerken van de partij.";
            }

            $stmt->close();
            $conn->close();

            // Redirect naar de lijstpagina
            header("Location: read.php");
            exit;
        }
    }
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
        <input type="text" id="naam" name="naam" value="<?php echo htmlspecialchars($partij['Partij_Naam']); ?>" required><br>

        <label for="volgorde">Volgordenummer:</label>
        <input type="number" id="volgorde" name="volgorde" value="<?php echo htmlspecialchars($partij['Partij_Volgorde']); ?>" required><br>

        <input type="submit" name="submit" value="Bijwerken">
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
