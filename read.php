<?php
include 'db.php';

$sql = "SELECT p.id, p.partijnaam, p.partijleider, v.type 
        FROM partijen p 
        JOIN verkiezing_db.verkiezingstypes v 
        ON p.verkiezingstype_id = v.id";
$result = $partijen_conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Partijnaam</th>
                <th>Partijleider</th>
                <th>Verkiezingstype</th>
                <th>Acties</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['partijnaam']}</td>
                <td>{$row['partijleider']}</td>
                <td>{$row['type']}</td>
                <td>
                    <a href='update.php?id={$row['id']}'>Bewerken</a> |
                    <a href='delete.php?id={$row['id']}'>Verwijderen</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Geen partijen gevonden.";
}
?>
