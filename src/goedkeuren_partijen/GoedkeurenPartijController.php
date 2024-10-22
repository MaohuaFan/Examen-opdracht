<?php
// Foutmeldingen inschakelen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
// src/goedkeuren_partijen/GoedkeurenPartijController.php

require_once 'GoedkeurenPartij.php';

class GoedkeurenPartijController {
    private $goedkeurenPartijModel;

    public function __construct($pdo) {
        $this->goedkeurenPartijModel = new GoedkeurenPartij($pdo);
    }

    public function keurPartijGoed($partij_id, $opmerkingen) {
        return $this->goedkeurenPartijModel->keurPartijGoed($partij_id, $opmerkingen);
    }

    public function keurPartijAf($partij_id, $opmerkingen) {
        return $this->goedkeurenPartijModel->keurPartijAf($partij_id, $opmerkingen);
    }
}

// Voorbeeld van het aanroepen van de controller
$controller = new GoedkeurenPartijController($pdo);
echo $controller->keurPartijGoed(1, 'Goedkeuring op basis van volledige documentatie.');
echo $controller->keurPartijAf(2, 'Onvoldoende documentatie ingediend.');
?>
