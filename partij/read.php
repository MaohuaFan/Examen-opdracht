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

// Haal alle partijen op met hun verkiezingstype
$sql = "
    SELECT p.id, p.partijnaam, vt.type AS verkiezingstype
    FROM partijen p
    LEFT JOIN verkiesbaren_partijen vp ON p.id = vp.partij_id
    LEFT JOIN verkiezingen v ON vp.verkiezing_id = v.id
    LEFT JOIN verkiezingstypes vt ON v.verkiezingstype_id = vt.id
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
            <th>Verkiezingstype</th>
            <th>Acties</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['partijnaam']) . "</td>";
                echo "<td>" . htmlspecialchars($row['verkiezingstype'] ? $row['verkiezingstype'] : 'Geen') . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row['id'] . "'>Bewerken</a> |
                        <a href='delete.php?id=" . $row['id'] . "' onclick=\"return confirm('Weet je zeker dat je deze partij wilt verwijderen?');\">Verwijderen</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Geen partijen gevonden.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Sluit de verbinding
$conn->close();
?>
