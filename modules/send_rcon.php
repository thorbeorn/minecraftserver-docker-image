<?php
require_once('../includes/Rcon.php');
use Thedudeguy\Rcon;
require_once('../' . $_POST['Path'] . '/config.php');

if(isset($_POST['Path']) && !empty($_POST['Path']) && isset($_POST['CMD']) && !empty($_POST['CMD'])) {
    $rcon = new Rcon($host, $port, $password, $timeout);
    if ($rcon->connect()) {
        $response = $rcon->sendCommand($_POST['CMD']);
    } else {
        // Erreur de connexion
    }
}