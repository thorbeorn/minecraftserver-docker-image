<?php
require_once '../configs/mysqlconfig.class.php';

class ModelsPDO {

    //Attributs utiles pour la connexion
    protected static $serveur = MySqlConfig::SERVER;
    protected static $base = MySqlConfig::DATABASE;
    protected static $utilisateur = MySqlConfig::USERNAME;
    protected static $passe = MySqlConfig::PASSWORD;
    
    //Attributs utiles pour la manipulation PDO de la BD
    protected static $pdoCnxBase = null;
    protected static $pdoStResults = null;
    protected static $requete = "";
    protected static $resultat = null;

    private $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . MySQLConfig::SERVER . ";dbname=" . MySQLConfig::DATABASE . ";charset=" . MySQLConfig::CHARSET,
                MySQLConfig::USERNAME,
                MySQLConfig::PASSWORD
            );
            // Définir le mode d'erreur PDO sur exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("ERROR: Could not connect. " . $e->getMessage());
        }
    }


}



