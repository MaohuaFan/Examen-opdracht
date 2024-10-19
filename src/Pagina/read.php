<?php include '../nav.php'; // Navigatiebalk ?>

<?php
// Directory waar de pagina's zijn opgeslagen
$directory = 'pages/'; // Zorg ervoor dat deze map bestaat

// Verkrijg een lijst van alle .php-bestanden in de opgegeven directory
$files = glob($directory . '*.php');

// Verwijder het huidige script uit de lijst (indien gewenst)
$files = array_filter($files, function($file) {
    return basename($file) !== 'read.php' && basename($file) !== 'insert.php'; // Voeg andere scriptbestanden toe die je wilt uitsluiten
});
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Overzicht van Pagina's</title>
</head>
<body>
    <h1>Overzicht van Aangemaakte Pagina's</h1>

    <?php if (empty($files)): ?>
        <p>Er zijn nog geen pagina's aangemaakt.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($files as $file): ?>
                <li>
                    <a href="<?php echo htmlspecialchars($file); ?>"><?php echo htmlspecialchars(basename($file)); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="insert.php">Nieuwe Pagina Aanmaken</a></p>
</body>
</html>
