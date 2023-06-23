<?php
    require_once 'ModelsPDO.php';
    require_once 'ErrorHandler.php';
    require_once 'lib/GestionEmail.php';


    class ResetPasswordController extends ModelsPDO {
        private $errorHandler;
    
        public function __construct() {
            parent::__construct();
            $this->errorHandler = new ErrorHandler();
        }
    
        public function resetPassword($email) {

            $email = htmlspecialchars($email);
            $check = $this->pdo->prepare('SELECT email, password FROM _user WHERE email = ?');
            $check->execute(array($email));
            $data = $check->fetch();
            $row = $check->rowCount();

            if($row == 1) {   
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $key = bin2hex(openssl_random_pseudo_bytes(32));
                    $expiry_date = new DateTime();
                    $expiry_date->add(new DateInterval('PT2H')); // PT2H means a period of time that is 2 hours long
                    $reset_key = $expiry_date->format('Y-m-d H:i:s');

                    $insert = $this->pdo->prepare('UPDATE _user SET key_verify = :key_verify, verify_key_date = :verify_key_date WHERE email = :email');
                    $insert->execute(array(
                        'key_verify' => $key,
                        'verify_key_date' => $reset_key,
                        'email' => $email
                    ));

                    // Send the confirmation email
                    GestionEmail::sendMailReset('Reinitialisation du mot de passe', $email, $key);
                    $this->errorHandler->ResetredirectWithError('success');
                }
                else { 
                    $this->errorHandler->ResetredirectWithError('email');
                }
            }
            else { 
                $this->errorHandler->ResetredirectWithError('notfound');
            }

        }


        public function validateKey($key) {
            $check = $this->pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
            $check->execute(array($key));
            $data = $check->fetch();
            $row = $check->rowCount();
        
            if ($row == 1) {
                $now = new DateTime();
                $keyDate = new DateTime($data['verify_key_date']);
                $interval = $now->diff($keyDate);
        
                if ($interval->h < 2) {
                    $this->errorHandler->ResetredirectWithUpdateError('valid');
                } else {
                    $this->errorHandler->ResetredirectWithUpdateError('expired');
                }
            } else {
                $this->errorHandler->ResetredirectWithUpdateError('invalid');
            }
        }
        

        public function resetConfirmPassword($key, $password, $confirm_password) {
            $check = $this->pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
            $check->execute(array($key));
            $data = $check->fetch();
            $row = $check->rowCount();
        
            if ($row == 1 && $password == $confirm_password) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $update = $this->pdo->prepare('UPDATE _user SET password = ?  WHERE key_verify = ? AND verify_key_date IS NOT NULL AND verify_key_date >= DATE_SUB(NOW(), INTERVAL 2 HOUR)');
                $update->execute(array($hashedPassword, $key));

                if ($update->rowCount() > 0) {
                    $this->errorHandler->LoginreDirectWithError('success');
                } else {
                    $this->errorHandler->redirectWithUpdateError('changed');
                }
            } else {
                $this->errorHandler->redirectWithUpdateError('match');
            }
        }
        

    }    
?>