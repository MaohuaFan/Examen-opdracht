<?php 
 session_start();
 require_once '../../vendor/autoload.php';
include '../nav.php'; // Navigatiebalk 
?>

<?php
require 'db.php';

// Haal alle kandidaten en hun bijbehorende partij op
$stmt = $pdo->query('
    SELECT kandidaten.Kandidaat_ID, kandidaten.Kandidaat_Naam, partijen.Partij_Naam 
    FROM kandidaten 
    INNER JOIN partijen ON kandidaten.Partij_ID = partijen.Partij_ID
');
$kandidaten = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaten en Partijen</title>
</head>
<body>
    <h1>Kandidaten en hun Partijen</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Kandidaat Naam</th>
                <th>Partij Naam</th>
                <th>Bewerken</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kandidaten as $kandidaat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($kandidaat['Kandidaat_Naam']); ?></td>
                    <td><?php echo htmlspecialchars($kandidaat['Partij_Naam']); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $kandidaat['Kandidaat_ID']; ?>">Bewerken</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="insert.php">koppel een kandidaat</a><br>

</body>
</html>
