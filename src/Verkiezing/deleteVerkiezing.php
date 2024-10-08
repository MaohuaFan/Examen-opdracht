<?php 
	// Auteur: Maohua Fan
	// Functie: 

	// Autoloader classes via composer
	require '../../vendor/autoload.php';
	use Bas\classes\Klant;

	if(isset($_POST["verwijderen"])){
		
		// Maak een object Klant
		$klant = new Klant(); 
		
		$klantId = $_GET['klantId'];

		// Delete Klant op basis van NR
		$klant->deleteKlant($klantId);

		echo '<script>alert("Klant '.$klantId.' verwijderd")</script>';
		echo "<script> location.replace('read.php'); </script>";
	}
?>



