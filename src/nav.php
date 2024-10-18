

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
