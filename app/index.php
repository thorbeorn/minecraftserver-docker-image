<?php
    session_start();
    ob_start();
    require_once 'configs/requirements.inc.php';
    require_once Chemins::CONTROLEURS . 'ErrorHandler.php';


    // On définit le contrôleur d'erreur
    $errorController = new ErrorHandler();

    // On récupère le paramètre de page depuis l'URL
    $page = $_GET['page'] ?? 'login'; // 'login' est la page par défaut

    // On définit le chemin vers le dossier des vues
    $viewPath = 'views/';

    // On utilise un switch pour vérifier la valeur de la page et inclure le bon fichier
    switch ($page) {
        case 'login':
            require_once $viewPath . 'login.inc.php';
            break;
        case 'register':
            require_once $viewPath . 'register.inc.php';
            break;
        case 'register-confirm':
            require_once $viewPath . 'register-confirm.inc.php';
            break;
        case 'reset-password':
            require_once $viewPath . 'reset-password.inc.php';
            break;
        case 'reset-password-confirm':
            require_once $viewPath . 'reset-password-confirm.inc.php';
            break;
        case 'condition':
            require_once $viewPath . 'condition.inc.php';
            break;
        default:
            // Si la page n'est pas reconnue, on affiche une erreur 404
            $errorController->handleError404();
            break;
    }

    require_once 'views/permanents/bodyend_vue.inc.php';
