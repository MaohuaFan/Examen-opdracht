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

// Variabelen om waarden te bewaren na een foutmelding
$partijnaam = '';
$partijvolgorde = '';
$error = '';

if (isset($_POST["submit"])) {
    // Haal de waarden op uit het formulier
    $partijnaam = $_POST['naam'];
    $partijvolgorde = $_POST['volgorde'];

    // Controleer of de volgorde al bestaat
    $checkSql = "SELECT * FROM partijen WHERE Partij_Volgorde = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("i", $partijvolgorde); // Bind volgorde parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Als de volgorde al bestaat, sla de foutmelding op
        $error = "Er bestaat al een partij met dit volgordenummer. Kies een ander nummer.";
    } else {
        // Als de volgorde niet bestaat, voeg de partij toe
        $sql = "INSERT INTO partijen (Partij_Naam, Partij_Volgorde) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $partijnaam, $partijvolgorde);

        if ($stmt->execute()) {
            echo "Partij succesvol toegevoegd!";
            // Redirect naar de lijstpagina
            header("Location: read.php");
            exit;
        } else {
            $error = "Er is een fout opgetreden bij het toevoegen van de partij.";
        }
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Partij Toevoegen</title>
</head>
<body>
    <h1>Nieuwe Partij Toevoegen</h1>

    <!-- Toon foutmelding als die er is -->
    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="naam">Naam van de partij:</label>
        <input type="text" id="naam" name="naam" value="<?php echo htmlspecialchars($partijnaam); ?>" required><br>

        <label for="volgorde">Volgordenummer:</label>
        <input type="number" id="volgorde" name="volgorde" value="<?php echo htmlspecialchars($partijvolgorde); ?>" required><br>

        <input type="submit" name="submit" value="Toevoegen">
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
