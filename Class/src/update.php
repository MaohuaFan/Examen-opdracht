<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $partijnaam = $_POST['partijnaam'];
    $partijleider = $_POST['partijleider'];
    $verkiezingstype_id = $_POST['verkiezingstype'];

    $sql = "UPDATE partijen SET partijnaam='$partijnaam', partijleider='$partijleider', verkiezingstype_id='$verkiezingstype_id' WHERE id='$id'";
    
    if ($partijen_conn->query($sql) === TRUE) {
        echo "Partij succesvol bijgewerkt!";
    } else {
        echo "Error: " . $sql . "<br>" . $partijen_conn->error;
    }
}

$sql = "SELECT * FROM partijen WHERE id='$id'";
$result = $partijen_conn->query($sql);
$row = $result->fetch_assoc();
?>

<form method="post" action="update.php?id=<?php echo $id; ?>">
    <label for="partijnaam">Partijnaam:</label>
    <input type="text" name="partijnaam" value="<?php echo $row['partijnaam']; ?>" required><br>

    <label for="partijleider">Partijleider:</label>
    <input type="text" name="partijleider" value="<?php echo $row['partijleider']; ?>" required><br>

    <label for="verkiezingstype">Verkiezingstype:</label>
    <select name="verkiezingstype" required>
        <?php
        $result = $verkiezing_conn->query("SELECT * FROM verkiezingstypes");
        while($verkiezing = $result->fetch_assoc()) {
            $selected = ($verkiezing['id'] == $row['verkiezingstype_id']) ? 'selected' : '';
            echo "<option value='" . $verkiezing['id'] . "' $selected>" . $verkiezing['type'] . "</option>";
        }
        ?>
    </select><br>

    <button type="submit">Update Partij</button>
</form>
