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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partijnaam = $_POST['partijnaam'];
    $partijleider = $_POST['partijleider'];
    $partijvolgorde = $_POST['volgorde']; // Volgordenummer toevoegen

    // SQL-query om een nieuwe partij toe te voegen
    $sql = "INSERT INTO partijen (Partij_Naam, Partij_Volgorde) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $partijnaam, $partijvolgorde); // Bind volgorde toe

    if ($stmt->execute()) {
        echo "Nieuwe partij succesvol toegevoegd!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Sluit de statement en de verbinding
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Partij Toevoegen</title>
</head>
<body>
    <h1>Partij Toevoegen</h1>
    <form method="post" action="create.php">
        <label for="partijnaam">Partijnaam:</label>
        <input type="text" name="partijnaam" required><br>

        <label for="partijleider">Partijleider:</label>
        <input type="text" name="partijleider" required><br>

        <label for="volgorde">Volgorde nummer:</label>
        <input type="number" name="volgorde" required><br>

        <button type="submit">Voeg Partij Toe</button>
    </form>
    <br>
    <a href="read.php">Terug naar de lijst</a>
</body>
</html>
