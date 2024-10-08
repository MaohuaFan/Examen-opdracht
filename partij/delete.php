<?php
// Verbinding maken met de database
$servername = "localhost";
$username = "root";
$password = "";
$database = "examenopdracht"; 

$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Controleer of er een ID is meegegeven om een partij te verwijderen
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];

    // SQL-query om de partij te verwijderen
    $delete_sql = "DELETE FROM partijen WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $delete_id);
    
    if ($delete_stmt->execute()) {
        // Redirect naar de lijstpagina na succesvol verwijderen
        header("Location: read.php?deleted=true");
        exit;
    } else {
        echo "Er is een fout opgetreden bij het verwijderen van de partij.";
    }

    // Sluit de statement en de verbinding
    $delete_stmt->close();
    $conn->close();
} else {
    echo "Geen partij geselecteerd voor verwijdering.";
    exit;
}
?>
