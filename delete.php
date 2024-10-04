<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM partijen WHERE id='$id'";

if ($partijen_conn->query($sql) === TRUE) {
    echo "Partij succesvol verwijderd!";
} else {
    echo "Error: " . $sql . "<br>" . $partijen_conn->error;
}
?>
