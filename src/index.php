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

<?php
// Geen session_start() hier, omdat dit al in de hoofdpagina's is aangeroepen
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Partij Management Systeem</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="partij/read.php">Bekijk Partijen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="kanidaten/read.php">Bekijk Kandidaten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="koppelen/read.php">Koppelen Kandidaten</a>
            </li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profiel.php">Mijn Profiel</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="stemgerechtigden/logout.php">Uitloggen</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="stemgerechtigden/login.php">Inloggen</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Eenvoudige stijlen voor de navbar -->
<style>
    .navbar {
        margin-bottom: 20px;
        background-color: #f8f9fa; /* Lichte achtergrondkleur */
    }
    .nav-link {
        color: #007bff; /* Kleur voor de navigatielinks */
        transition: color 0.2s; /* Voegt een overgangseffect toe */
    }
    .nav-link:hover {
        color: #0056b3; /* Donkerdere kleur bij hover */
    }
    .dropdown-menu {
        background-color: #ffffff; /* Achtergrondkleur voor dropdown-menu */
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
