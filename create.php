<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partijnaam = $_POST['partijnaam'];
    $partijleider = $_POST['partijleider'];
    $verkiezingstype_id = $_POST['verkiezingstype'];

    $sql = "INSERT INTO partijen (partijnaam, partijleider, verkiezingstype_id) VALUES ('$partijnaam', '$partijleider', '$verkiezingstype_id')";
    
    if ($partijen_conn->query($sql) === TRUE) {
        echo "Nieuwe partij succesvol toegevoegd!";
    } else {
        echo "Error: " . $sql . "<br>" . $partijen_conn->error;
    }
}
?>

<!-- Formulier om nieuwe partij toe te voegen -->
<form method="post" action="create.php">
    <label for="partijnaam">Partijnaam:</label>
    <input type="text" name="partijnaam" required><br>

    <label for="partijleider">Partijleider:</label>
    <input type="text" name="partijleider" required><br>

    <label for="verkiezingstype">Verkiezingstype:</label>
    <select name="verkiezingstype" required>
        <?php
        $result = $verkiezing_conn->query("SELECT * FROM verkiezingstypes");
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
        }
        ?>
    </select><br>

    <button type="submit">Voeg Partij Toe</button>
</form>
