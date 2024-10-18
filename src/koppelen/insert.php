<?php
require 'db.php';

// Haal alle kandidaten op voor de dropdown
$stmtKandidaten = $pdo->query('SELECT Kandidaat_ID, Kandidaat_Naam FROM kandidaten');
$kandidaten = $stmtKandidaten->fetchAll();

// Haal alle partijen op voor de dropdown
$stmtPartijen = $pdo->query('SELECT Partij_ID, Partij_Naam FROM partijen');
$partijen = $stmtPartijen->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kandidaat_id = $_POST['kandidaat_id'];
    $partij_id = $_POST['partij_id'];

    // Update de kandidaat met het gekozen partij_id
    $stmt = $pdo->prepare('UPDATE kandidaten SET Partij_ID = ? WHERE Kandidaat_ID = ?');
    $stmt->execute([$partij_id, $kandidaat_id]);

    // Redirect na succesvolle invoer
    header('Location: read.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koppel Kandidaat aan Partij</title>
</head>
<body>
    <h1>Koppel een Kandidaat aan een Partij</h1>

    <form method="post">
        <label for="kandidaat_id">Kies een Kandidaat:</label>
        <select id="kandidaat_id" name="kandidaat_id" required>
            <?php foreach ($kandidaten as $kandidaat): ?>
                <option value="<?php echo $kandidaat['Kandidaat_ID']; ?>">
                    <?php echo htmlspecialchars($kandidaat['Kandidaat_Naam']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="partij_id">Kies een Partij:</label>
        <select id="partij_id" name="partij_id" required>
            <?php foreach ($partijen as $partij): ?>
                <option value="<?php echo $partij['Partij_ID']; ?>">
                    <?php echo htmlspecialchars($partij['Partij_Naam']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <button type="submit">Koppel Kandidaat aan Partij</button>
    </form>

    <br>
    <a href="read.php">Terug naar overzicht</a>
</body>
</html>
