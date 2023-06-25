<?php 
    require_once 'configs/requirements.inc.php';
    require_once Chemins::CONTROLEURS . 'ErrorHandler.php';

    // On définit le contrôleur d'erreur
    $errorController = new ErrorHandler();


    require_once Chemins::VUES_PERMENENTES . 'bodyenddash_vue.inc.php';