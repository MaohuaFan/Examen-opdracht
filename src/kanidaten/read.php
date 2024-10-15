<?php
include 'db.php';

$sql = "SELECT kandidaten.Kandidaat_ID, kandidaten.Kandidaat_Naam, partijen.Partij_Naam 
        FROM kandidaten 
        JOIN partijen ON kandidaten.Partij_ID = partijen.Partij_ID";
$stmt = $conn->query($sql);

echo "<table border='1'>
        <tr>
            <th>Kandidaat Naam</th>
            <th>Partij Naam</th>
            <th>Acties</th>
        </tr>";

while ($row = $stmt->fetch()) {
    echo "<tr>
            <td>" . $row['Kandidaat_Naam'] . "</td>
            <td>" . $row['Partij_Naam'] . "</td>
            <td>
                <a href='update.php?id=" . $row['Kandidaat_ID'] . "'>Bewerken</a> | 
                <a href='delete.php?id=" . $row['Kandidaat_ID'] . "' onclick=\"return confirm('Weet je zeker dat je deze kandidaat wilt verwijderen?');\">Verwijderen</a>
            </td>
          </tr>";
}
echo "</table>";
?>
