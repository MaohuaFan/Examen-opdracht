<?php
include 'db.php'; // Verbind met de database

$sql = "SELECT v.id, v.naam, v.gecreëerd_op, p.partijnaam 
        FROM verkiesbaren v 
        LEFT JOIN verkiesbaren_partijen vp ON v.id = vp.verkiesbare_id 
        LEFT JOIN partijen p ON vp.partij_id = p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaten Lijst</title>
</head>
<body>
    <h1>Kandidaten Lijst</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Gecreëerd op</th>
            <th>Partij</th>
            <th>Acties</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['naam']; ?></td>
                <td><?php echo $row['gecreëerd_op']; ?></td>
                <td><?php echo $row['partijnaam']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Bewerken</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Verwijderen</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="create.php">Voeg nieuwe kandidaat toe</a>
</body>
</html>

<?php
$conn->close();
?>
