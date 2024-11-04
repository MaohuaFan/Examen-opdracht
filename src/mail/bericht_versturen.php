<?php
session_start();
require_once '../koppelen/db.php'; // Zorg ervoor dat dit pad klopt

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ontvanger_id = $_POST['ontvanger'];
    $onderwerp = $_POST['onderwerp'];
    $bericht = $_POST['bericht'];

    if (!empty($ontvanger_id) && !empty($onderwerp) && !empty($bericht)) {
        $sql = "INSERT INTO berichten (ontvanger_id, onderwerp, bericht, verzend_datum, gelezen) 
                VALUES (:ontvanger_id, :onderwerp, :bericht, NOW(), 0)";
        
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ':ontvanger_id' => $ontvanger_id,
                ':onderwerp' => $onderwerp,
                ':bericht' => $bericht
            ]);
            echo "Bericht succesvol verstuurd!";
        } catch (PDOException $e) {
            echo "Fout bij versturen bericht: " . $e->getMessage();
        }
    } else {
        echo "Alle velden zijn verplicht!";
    }
}
?>
<?php
require_once '../koppelen/db.php'; // Zorg ervoor dat dit pad klopt

// Haal alle ontvangers op uit de database
$stmt = $pdo->query("SELECT id, naam FROM gebruikers"); // Zorg dat de juiste tabel wordt gebruikt

?>
<form method="POST" action="bericht_versturen.php">
    <label for="ontvanger">Selecteer Ontvanger:</label>
    <select name="ontvanger" id="ontvanger" required>
        <?php while ($row = $stmt->fetch()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['naam']; ?></option>
        <?php endwhile; ?>
    </select>

    <label for="onderwerp">Onderwerp:</label>
    <input type="text" name="onderwerp" id="onderwerp" required>

    <label for="bericht">Bericht:</label>
    <textarea name="bericht" id="bericht" required></textarea>

    <button type="submit">Verstuur Bericht</button>
</form>
