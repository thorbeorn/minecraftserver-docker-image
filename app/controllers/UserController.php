<?php

require_once Chemins::MODELS . 'User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function getUserData($pseudo)
    {
        $user = $this->userModel->getUser($pseudo);

        if ($user) {
            $userData = [
                'pseudo' => $user['pseudo'],
                'email' => $user['email'],
                'image' => $user['picture_account']
            ];

            return $userData;
        }

        return null;
    }
}