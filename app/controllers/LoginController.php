<?php

require_once 'ModelsPDO.php';
require_once 'ErrorHandler.php'; 

class LoginController extends ModelsPDO {
    private $errorHandler;

    public function __construct() {
        parent::__construct(); // Pour appeler le constructeur de la classe parent (ModelsPDO) qui initialise $pdo
        $this->errorHandler = new ErrorHandler();
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
                $this->errorHandler->LoginreDirectWithError('password');
            }
        } else {
            $this->errorHandler->LoginreDirectWithError('already');
        }
    }
}
