<?php 
    require_once 'ModelsPDO.php';

    class User {
        private $pdo;
    
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function getUser($pseudo) {
            $stmt = $this->pdo->prepare('SELECT * FROM _user WHERE pseudo = :pseudo');
            $stmt->execute(['pseudo' => $pseudo]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function deleteUser($pseudo) {
            $stmt = $this->pdo->prepare('DELETE FROM _user WHERE pseudo = :pseudo');
            $stmt->execute(['pseudo' => $pseudo]);
        }
    }