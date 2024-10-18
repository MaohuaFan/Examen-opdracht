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

// Haal alle partijen op zonder verkiezingstype en verkiezingsnaam
$sql = "
    SELECT Partij_ID, Partij_Naam
    FROM partijen
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Partijenlijst</title>
</head>
<body>
    <h1>Partijenlijst</h1>
    <br>
    <a href="insert.php">Voeg een nieuwe partij toe</a>
    <br><br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Partijnaam</th>
            <th>Acties</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Partij_ID'] . "</td>";
                echo "<td>" . htmlspecialchars($row['Partij_Naam']) . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row['Partij_ID'] . "'>Bewerken</a> |
                        <a href='delete.php?id=" . $row['Partij_ID'] . "' onclick=\"return confirm('Weet je zeker dat je deze partij wilt verwijderen?');\">Verwijderen</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Geen partijen gevonden.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Sluit de verbinding
$conn->close();
?>
