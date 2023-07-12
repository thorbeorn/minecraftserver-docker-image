<?php
    require_once Chemins::LIBS . 'vendor/autoload.php';
 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
    $dotenv->load();

    class ParametreServer {
        // C'est pour connaitre le IP et le port du serveur PHP pour la redirection du mail via le formulaire de connexion
        public static function getIp() {
            return $_ENV['IP_SERVER_PHP'];
        }

        public static function getPort() {
            return $_ENV['PORT_SERVER_PHP'];
        }
    }
?>