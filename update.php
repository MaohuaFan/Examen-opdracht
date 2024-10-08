<?php
// auteur: Lorenzo van der Horst
// functie: update class Partij

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Partij;

// Fetch partij details for pre-filling the form
if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $partij = new Partij();
    $partijData = $partij->getPartij($id);
}

// Process form submission for updating partij details
if (isset($_POST["update"]) && isset($_GET["id"])) {
    // Retrieve and sanitize form input
    $partijnaam = filter_input(INPUT_POST, 'partijnaam', FILTER_SANITIZE_STRING);

    // Simple validation
    if ($partijnaam) {
        // Instantiate the Partij class and set properties
        $partij = new Partij();
        $row = [
            'id' => $id,
            'partijnaam' => $partijnaam,
        ];

        // Update the partij
        if ($partij->updatePartij($row)) {
            echo "Partij succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van partij.";
        }
    } else {
        echo "Vul alstublieft alle velden correct in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Partij</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>CRUD Partij</h1>
    <h2>Bijwerken</h2>
    <?php if (isset($partijData)): ?>
        <form method="post">
            <label for="pn">Partijnaam:</label>
            <input type="text" id="pn" name="partijnaam" value="<?= htmlspecialchars($partijData['partijnaam']) ?>" required/>
            <br><br>
            <input type='submit' name='update' value='Bijwerken'>
        </form>
    <?php else: ?>
        <p>Geen partij gevonden.</p>
    <?php endif; ?>
    <br>
    <a href='read.php'>Terug</a>
</body>
</html>
