<?php

require_once Chemins::LIBS . 'email.class.php';
require_once 'ModelsPDO.php';
require_once 'ErrorHandler.php';

class RegisterController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
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
                            header(RegisterDirectWithSuccess('success'));
                            exit();
                        } else {
                            header(RegisterDirectWithError('password'));
                            exit();
                        }
                    } else {
                        header(RegisterDirectWithError('email'));
                        exit();
                    }
                } else {
                    header(RegisterDirectWithError('email_length'));
                    exit();
                }
            } else {
                header(RegisterDirectWithError('pseudo_length'));
                exit();
            }
        } else {
            header(RegisterDirectWithError('already'));
            exit();
        }
    }

    public function confirmAccount($key) {
        $ErrorMessage = '';

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
                    $ErrorMessage = 'success';
                } else {
                    // La clé n'est plus valide, envoyez un nouvel e-mail de confirmation
                    $ErrorMessage = 'expired';
                }
            } else {
                // La clé n'est pas valide
                $ErrorMessage = 'invalid';
            }
        } else {
            header('Location: inscription.php');
            exit();
        }

        // Retourner le message de confirmation et la classe CSS
        RegistreConfirmationError($ErrorMessage)
    }


}
?>