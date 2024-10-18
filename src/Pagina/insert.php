<?php
// Check of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de gegevens van het formulier
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Valideer de invoer
    if (!empty($title) && !empty($content)) {
        // Maak een veilige bestandsnaam (zonder spaties en speciale karakters)
        $filename = strtolower(str_replace(' ', '_', $title)) . ".php";

        // Maak de inhoud van de nieuwe pagina
        $pageContent = "<!DOCTYPE html>\n";
        $pageContent .= "<html lang='nl'>\n";
        $pageContent .= "<head>\n";
        $pageContent .= "<meta charset='UTF-8'>\n";
        $pageContent .= "<title>" . htmlspecialchars($title) . "</title>\n";
        $pageContent .= "</head>\n";
        $pageContent .= "<body>\n";
        $pageContent .= "<h1>" . htmlspecialchars($title) . "</h1>\n";
        $pageContent .= "<p>" . nl2br(htmlspecialchars($content)) . "</p>\n";
        $pageContent .= "</body>\n";
        $pageContent .= "</html>";

        // Sla de inhoud op in een nieuw bestand
        if (file_put_contents($filename, $pageContent)) {
            echo "<p>De pagina is succesvol aangemaakt: <a href='$filename'>$filename</a></p>";
        } else {
            echo "<p>Er is een fout opgetreden bij het aanmaken van de pagina.</p>";
        }
    } else {
        echo "<p>Vul alle velden in!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Pagina Aanmaken</title>
</head>
<body>
    <h1>Maak een nieuwe pagina aan</h1>

    <!-- Formulier om een nieuwe pagina aan te maken -->
    <form action="insert.php" method="post">
        <label for="title">Titel van de pagina:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Inhoud van de pagina:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br><br>

        <input type="submit" value="Pagina Aanmaken">
    </form>
</body>
</html>
