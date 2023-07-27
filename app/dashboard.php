<?php 
    session_start();
    // On inclut le fichier de configuration
    require_once 'configs/requirements_dash.inc.php';
    require_once Chemins::CONTROLEURS . 'ErrorHandler.php';
    
    // On définit le contrôleur d'erreur
    $errorController = new ErrorHandler();

    // On récupère le paramètre de page depuis l'URL
    $page = $_GET['page'] ?? 'home'; // 'login' est la page par défaut

    // On définit le chemin vers le dossier des vues
    $viewPath = 'views/';

    // On utilise un switch pour vérifier la valeur de la page et inclure le bon fichier
    switch ($page) {
        case 'home':
            require_once $viewPath . 'home.inc.php';
            break;
        default:
            // Si la page n'est pas reconnue, on affiche une erreur 404
            $errorController->handleError404();
            break;
    }

    require_once Chemins::VUES_PERMENENTES . 'footerdash_vue.inc.php';