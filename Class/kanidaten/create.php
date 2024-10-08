<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaat Toevoegen</title>
</head>
<body>
    <h1>Voeg een nieuwe kandidaat toe</h1>
    <form method="POST" action="store.php">
        <label for="naam">Naam van de kandidaat:</label>
        <input type="text" id="naam" name="naam" required>
        
        <label for="partij_id">Selecteer partij:</label>
        <select id="partij_id" name="partij_id" required>
            <option value="">Selecteer een partij</option>
            <?php
            include 'db.php'; // Verbind met de database
            $sqlPartijen = "SELECT id, partijnaam FROM partijen";
            $resultPartijen = $conn->query($sqlPartijen);
            if ($resultPartijen->num_rows > 0) {
                while ($row = $resultPartijen->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['partijnaam'] . '</option>';
                }
            } else {
                echo '<option value="">Geen partijen gevonden</option>';
            }
            ?>
        </select>

        <input type="submit" value="Toevoegen">
    </form>
    <a href="read.php">Bekijk alle kandidaten</a>
</body>
</html>
