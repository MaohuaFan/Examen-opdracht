<!--
	Auteur: Maohua Fan
	Function: home page CRUD Klant
-->
<!DOCTYPE html>
<html lang="nl">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Crud</title>
		<link rel="stylesheet" href="../style.css">
	</head>
	<body>
		<?php
			include_once('../nav.php');
		?>
		<h1>CRUD Klant</h1>
		<h2>Overzicht</h2>
		<a href='insert.php'>Toevoegen nieuwe klant</a><br><br>	
		<!-- Search Form -->
    	<form method="GET" action="">
			<input type="text" name="search" placeholder="Zoek klant..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
			<input type="submit" value="Zoeken">
    	</form><br>
	<?php
		// Autoloader classes via composer
		require '../../vendor/autoload.php';

		use Bas\classes\Klant;

		// Maak een object Klant
		$klant = new Klant();

		// Fetch search query if available
		$search = isset($_GET['search']) ? $_GET['search'] : '';
	
		// Start CRUD
		$klant->crudKlant($search);
	?>
	</body>
</html>