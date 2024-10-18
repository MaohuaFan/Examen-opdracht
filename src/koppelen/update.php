<?php
require 'db.php';

// Controleer of een geldig kandidaat ID is meegegeven
if (!isset($_GET['id'])) {
    die('Geen kandidaat geselecteerd');
}

$kandidaat_id = $_GET['id'];

// Haal de huidige gegevens van de geselecteerde kandidaat op, inclusief naam en huidige partij
$stmt = $pdo->prepare('
    SELECT kandidaten.Kandidaat_Naam, kandidaten.Partij_ID 
    FROM kandidaten 
    WHERE kandidaten.Kandidaat_ID = ?
');
$stmt->execute([$kandidaat_id]);
$kandidaat = $stmt->fetch();

if (!$kandidaat) {
    die('Kandidaat niet gevonden');
}

// Haal alle partijen op voor de dropdown
$stmtPartijen = $pdo->query('SELECT Partij_ID, Partij_Naam FROM partijen');
$partijen = $stmtPartijen->fetchAll();

// Verwerk het formulier als het is verzonden
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partij_id = $_POST['partij_id'];

    // Update alleen de partij in de database
    $stmt = $pdo->prepare('UPDATE kandidaten SET Partij_ID = ? WHERE Kandidaat_ID = ?');
    $stmt->execute([$partij_id, $kandidaat_id]);

    // Redirect na succesvolle update
    header('Location: read.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Kandidaat Partij</title>
</head>
<body>
    <h1>Bewerk Kandidaat Partij</h1>

    <p>Kandidaat: <strong><?php echo htmlspecialchars($kandidaat['Kandidaat_Naam']); ?></strong></p>

    <form method="post">
        <label for="partij_id">Kies een Partij:</label>
        <select id="partij_id" name="partij_id" required>
            <?php foreach ($partijen as $partij): ?>
                <option value="<?php echo $partij['Partij_ID']; ?>" 
                    <?php if ($partij['Partij_ID'] == $kandidaat['Partij_ID']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($partij['Partij_Naam']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit">Opslaan</button>
    </form>

    <br>
    <a href="read.php">Terug naar overzicht</a>
</body>
</html>
