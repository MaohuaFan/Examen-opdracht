<?php
session_start(); // Start de sessie
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partij Management Systeem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Eenvoudige stijlen voor de navbar */
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'nav.php'; // Include de navigatiebalk ?>

<div class="container">
    <h1>Welkom bij het Partij Management Systeem</h1>
    <p>Test 3</p>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Je bent ingelogd als: <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></p>
    <?php else: ?>
        <p>Je bent niet ingelogd. <a href="stemgerechtigden/login.php">Klik hier om in te loggen.</a></p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
