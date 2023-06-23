<?php

require_once 'ModelsPDO.php';
require_once 'ErrorHandler.php'; 

class LoginController extends ModelsPDO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function loginUser($pseudo, $password) {
        $stmt = $this->pdo->prepare('SELECT pseudo, password FROM _user WHERE pseudo = :pseudo');
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();
        $data = $stmt->fetch();
        $row = $stmt->rowCount();

        if ($row > 0) {
            if (password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data['pseudo'];
                header('Location: dashboard.php');
                exit();
            } else {
                LoginreDirectWithError('password');
            }
        } else {
            LoginreDirectWithError('already');
        }
    }
}
