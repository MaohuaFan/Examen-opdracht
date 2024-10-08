<?php




// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "verkiezingen"; // Zet hier de naam van je database

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal de partijen op uit de database
$sqlPartijen = "SELECT id, partijnaam FROM partijen";
$resultPartijen = $conn->query($sqlPartijen);
?>

<!-- Formulier -->
<form method="POST" action="submit_kandidaat.php">
    <!-- Naam invoer -->
    <label for="naam">Naam van de kandidaat:</label>
    <input type="text" id="naam" name="naam" required>
    <!-- Positie invoerveld -->
<label for="positie">Positie:</label>
<input type="number" id="positie" name="positie" required>

    <!-- Dropdown voor partijen -->
    <label for="partij_id">Selecteer partij:</label>
    <select id="partij_id" name="partij_id" required>
        <option value="">Selecteer een partij</option>
        <?php
        if ($resultPartijen->num_rows > 0) {
            // Loop door de rijen en toon de opties
            while($row = $resultPartijen->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['partijnaam'] . '</option>';
            }
        } else {
            echo '<option value="">Geen partijen gevonden</option>';
        }
        ?>
    </select>

    <?php
// Haal de verkiezingen op uit de database
$sqlVerkiezingen = "SELECT id, verkiezingsnaam FROM verkiezingen";
$resultVerkiezingen = $conn->query($sqlVerkiezingen);
?>

<!-- Dropdown voor verkiezingen -->
<label for="verkiezing_id">Selecteer verkiezing:</label>
<select id="verkiezing_id" name="verkiezing_id" required>
    <option value="">Selecteer een verkiezing</option>
    <?php
    if ($resultVerkiezingen->num_rows > 0) {
        // Loop door de rijen en toon de opties
        while($row = $resultVerkiezingen->fetch_assoc()) {
            echo '<option value="' . $row['id'] . '">' . $row['verkiezingsnaam'] . '</option>';
        }
    } else {
        echo '<option value="">Geen verkiezingen gevonden</option>';
    }
    ?>



</select>

    
    <input type="submit" name="insert" value="Toevoegen">
</form>



<a href="index2.php">Test 2</a>