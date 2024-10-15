<?php
include 'db.php'; // Verbind met de database

$id = $_GET['id'];

// Haal kandidaat en partij op
$sql = "SELECT v.naam, vp.partij_id, p.partijnaam 
        FROM verkiesbaren v 
        LEFT JOIN verkiesbaren_partijen vp ON v.id = vp.verkiesbare_id 
        LEFT JOIN partijen p ON vp.partij_id = p.id 
        WHERE v.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($naam, $partij_id, $partijnaam);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaat Bewerken</title>
</head>
<body>
    <h1>Bewerk Kandidaat</h1>
    <form method="POST" action="update.php?id=<?php echo $id; ?>">
        <label for="naam">Naam van de kandidaat:</label>
        <input type="text" id="naam" name="naam" value="<?php echo $naam; ?>" required>

        <label for="partij_id">Selecteer partij:</label>
        <select id="partij_id" name="partij_id" required>
            <?php
            // Lijst van partijen ophalen
            $sqlPartijen = "SELECT id, partijnaam FROM partijen";
            $resultPartijen = $conn->query($sqlPartijen);
            if ($resultPartijen->num_rows > 0) {
                while ($row = $resultPartijen->fetch_assoc()) {
                    $selected = ($row['id'] == $partij_id) ? 'selected' : '';
                    echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['partijnaam'] . '</option>';
                }
            } else {
                echo '<option value="">Geen partijen gevonden</option>';
            }
            ?>
        </select>

        <input type="submit" value="Bijwerken">
    </form>
    <a href="read.php">Terug naar de kandidatenlijst</a>
</body>
</html>
