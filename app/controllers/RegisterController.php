<?php

require_once 'ModelsPDO.php';
require_once 'ErrorHandler.php';
require_once 'lib/GestionEmail.php';


class RegisterController extends ModelsPDO {
    private $errorHandler;
    
    public function __construct() {
        parent::__construct();
        $this->errorHandler = new ErrorHandler();
    }

    public function registerUser($pseudo, $email, $password, $passwordRetype) {
        $pseudo = htmlspecialchars($pseudo);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);
        $passwordRetype = htmlspecialchars($passwordRetype);

        $check = $this->pdo->prepare('SELECT pseudo, email, password FROM _user WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email);

        if ($row == 0) {
            if (strlen($pseudo) <= 255) {
                if (strlen($email) <= 50) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if ($password === $passwordRetype) {
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                            // Generate random key
                            $key = bin2hex(openssl_random_pseudo_bytes(32));
                            $date = new DateTime();
                            $date_create_account = $date->format('Y-m-d H:i:s');
                            $expiry_date = new DateTime();
                            $expiry_date->add(new DateInterval('PT2H'));
                            $expiry_date = $expiry_date->format('Y-m-d H:i:s');

                            $insert = $this->pdo->prepare('INSERT INTO _user(pseudo, email, password, date_create_account, key_verify, verify_key_date, account_confirmed) VALUES(:pseudo, :email, :password, :date_create_account, :key_verify, :verify_key_date, :account_confirmed)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'date_create_account' => $date_create_account,
                                'key_verify' => $key,
                                'verify_key_date' => $expiry_date,
                                'account_confirmed' => 0
                            ));

                            GestionEmail::sendMailVerify('Confirmation de compte', $email, $key);
                            $this->errorHandler->RegisterDirectWithError('success');
                            exit();
                        } else {
                            $this->errorHandler->RegisterDirectWithError('password');
                            exit();
                        }
                    } else {
                        $this->errorHandler->RegisterDirectWithError('email');
                        exit();
                    }
                } else {
                    $this->errorHandler->RegisterDirectWithError('email_length');
                    exit();
                }
            } else {
                $this->errorHandler->RegisterDirectWithError('pseudo_length');
                exit();
            }
        } else {
            $this->errorHandler->RegisterDirectWithError('already');
            exit();
        }
    }

    public function confirmAccount($key) {

        if (!empty($key)) {
            $key = htmlspecialchars($key);

            $check = $this->pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
            $check->execute(array($key));
            $data = $check->fetch();
            $row = $check->rowCount();

            if ($row == 1) {
                $now = new DateTime();
                $keyDate = new DateTime($data['verify_key_date']);
                $interval = $now->diff($keyDate);

                if ($interval->h < 2) {
                    $update = $this->pdo->prepare('UPDATE _user SET account_confirmed = 1 WHERE key_verify = ?');
                    $this->errorHandler->RegistreConfirmationError('success');
                    exit();
                } else {
                    // La clé n'est plus valide, envoyez un nouvel e-mail de confirmation
                    GestionEmail::sendMailVerify('Confirmation de compte', $data['email'], $key);
                    $this->errorHandler->RegistreConfirmationError('expired');
                    exit();
                }
            } else {
                // La clé n'est pas valide
                $this->errorHandler->RegistreConfirmationError('invalid');
                exit();
            }
        } else {
            // Pas de clé fournie
            $this->errorHandler->header('Location: index.php?page=register');
            exit();
        }
    }


}
?>