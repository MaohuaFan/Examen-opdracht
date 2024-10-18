<?php
include 'db.php';

// Haal alle kandidaten op
$sql = "SELECT kandidaten.Kandidaat_ID, kandidaten.Kandidaat_Naam, partijen.Partij_Naam 
        FROM kandidaten 
        LEFT JOIN partijen ON kandidaten.Partij_ID = partijen.Partij_ID";
$stmt = $conn->query($sql);
$kandidaten = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaten Overzicht</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Functie voor bevestigingspopup bij verwijderen
        function confirmDelete(kandidaatID, kandidaatNaam, row) {
            if (confirm("Weet je zeker dat je '" + kandidaatNaam + "' wilt verwijderen?")) {
                // AJAX-aanroep om de kandidaat te verwijderen
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: { id: kandidaatID },
                    success: function(response) {
                        if (response === "success") {
                            // Verwijder de rij van de tabel zonder de pagina te verversen
                            $(row).closest('tr').remove();
                        } else {
                            alert("Er is iets misgegaan bij het verwijderen.");
                        }
                    },
                    error: function() {
                        alert("Er is een fout opgetreden. Probeer het later opnieuw.");
                    }
                });
            }
        }
    </script>
</head>
<body>
    <h2>Kandidaten Overzicht</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Kandidaat Naam</th>
                <th>Partij Naam</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kandidaten as $kandidaat): ?>
                <tr>
                    <td><?php echo $kandidaat['Kandidaat_Naam']; ?></td>
                    <td><?php echo $kandidaat['Partij_Naam']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $kandidaat['Kandidaat_ID']; ?>">Bewerken</a> |
                        <!-- Voeg onclick-event toe voor AJAX-verwijdering -->
                        <a href="javascript:void(0);" 
                           onclick="confirmDelete('<?php echo $kandidaat['Kandidaat_ID']; ?>', '<?php echo $kandidaat['Kandidaat_Naam']; ?>', this)">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="insert.php">Nieuwe Kandidaat Toevoegen</a>
<br>

    <!-- Terug naar hoofdpagina link -->
    <a href="../index.html">Terug naar Hoofdpagina</a>
</body>
</html>
