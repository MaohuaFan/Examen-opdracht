<?php
include 'db.php';

if (isset($_POST["insert"])) {
    $naam = $_POST['naam'];
    $partij_id = $_POST['partij_id'];

    $sql = "INSERT INTO kandidaten (Kandidaat_Naam, Partij_ID) VALUES (:naam, :partij_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':partij_id', $partij_id);

    if ($stmt->execute()) {
        echo "Kandidaat succesvol toegevoegd!";
    } else {
        echo "Er is een fout opgetreden.";
    }
}
?>

<!-- HTML Form voor toevoegen van kandidaat -->
<form method="POST" action="create.php">
    <label for="naam">Kandidaat Naam:</label>
    <input type="text" id="naam" name="naam" required><br>

    <label for="partij_id">Selecteer Partij:</label>
    <select id="partij_id" name="partij_id" required>
        <?php
        $partijen = $conn->query("SELECT Partij_ID, Partij_Naam FROM partijen");
        foreach ($partijen as $partij) {
            echo "<option value='" . $partij['Partij_ID'] . "'>" . $partij['Partij_Naam'] . "</option>";
        }
        ?>
    </select><br>

    <input type="submit" name="insert" value="Toevoegen">
</form>
