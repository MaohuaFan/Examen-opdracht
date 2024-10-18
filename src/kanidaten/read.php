<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaten Overzicht</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Kandidaten Overzicht</h2>

    <table>
        <tr>
            <th>Kandidaat Naam</th>
           
            <th>Acties</th>
        </tr>
        <?php
        include 'db.php';

        $sql = "SELECT kandidaten.Kandidaat_ID, kandidaten.Kandidaat_Naam, partijen.Partij_Naam 
                FROM kandidaten 
                JOIN partijen ON kandidaten.Partij_ID = partijen.Partij_ID";
        $stmt = $conn->query($sql);
        $kandidaten = $stmt->fetchAll();

        foreach ($kandidaten as $kandidaat) {
            echo "<tr>";
            echo "<td>" . $kandidaat['Kandidaat_Naam'] . "</td>";
       
            echo "<td>
                    <a href='update.php?id=" . $kandidaat['Kandidaat_ID'] . "'>Bewerken</a> | 
                    <a href='delete.php?id=" . $kandidaat['Kandidaat_ID'] . "'>Verwijderen</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <!-- Voeg een link toe om een nieuwe kandidaat toe te voegen -->
    <a href="insert.php">Nieuwe Kandidaat Toevoegen</a>
    <br><br>
    <a href="../index.html">Terug naar Home</a>
</body>
</html>
