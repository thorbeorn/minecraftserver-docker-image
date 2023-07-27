<?php

    /**
     * FILEPATH: _DIR_ \controllers\RegisterController.php
     * This class represents the RegisterController, which is responsible for handling user registration and account confirmation.
     * It extends the ModelsPDO class and uses the ErrorHandler class for error handling.
    */

    require_once Chemins::MODELS . 'ModelsPDO.php';
    require_once 'ErrorHandler.php';
    require_once 'lib/GestionEmail.php';


    class RegisterController extends ModelsPDO {
        // Define a private variable to hold an instance of the ErrorHandler class
        private $errorHandler;

        // Constructor method for the RegisterController class
        public function __construct() {
            // Call the parent constructor method
            parent::__construct();
            // Instantiate a new ErrorHandler object and assign it to the $errorHandler variable
            $this->errorHandler = new ErrorHandler();
        }

        // Method to register a new user
        public function registerUser($pseudo, $email, $password, $passwordRetype) {
            // Sanitize input values
            $pseudo = htmlspecialchars($pseudo);
            $email = htmlspecialchars($email);
            $password = htmlspecialchars($password);
            $passwordRetype = htmlspecialchars($passwordRetype);

            // Prepare a SELECT statement to check if the user already exists in the database
            $check = $this->pdo->prepare('SELECT pseudo, email, password FROM _user WHERE pseudo = ?');
            $check->execute(array($pseudo));
            $data = $check->fetch();
            $row = $check->rowCount();

            // Convert email to lowercase
            $email = strtolower($email);

            // If the user does not already exist in the database
            if ($row == 0) {
                // If the length of the pseudo is less than or equal to 255 characters
                if (strlen($pseudo) <= 255) {
                    // If the length of the email is less than or equal to 50 characters
                    if (strlen($email) <= 50) {
                        // If the email is valid
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            // If the password and passwordRetype match
                            if ($password === $passwordRetype) {
                                // Hash the password using bcrypt with a cost of 12
                                $cost = ['cost' => 12];
                                $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                                // Generate a random key for email verification
                                $key = bin2hex(openssl_random_pseudo_bytes(32));
                                $date = new DateTime();
                                $date_create_account = $date->format('Y-m-d H:i:s');
                                $expiry_date = new DateTime();
                                $expiry_date->add(new DateInterval('PT2H'));
                                $expiry_date = $expiry_date->format('Y-m-d H:i:s');

                                // Générer une URL pour télécharger l'image
                                $url = "https://minotar.net/helm/$pseudo/100.png";

                                // Chemin vers le dossier d'images
                                $path = Chemins::IMAGES_AVATARS; 

                                // Télécharger l'image
                                $ch = curl_init($url);
                                $fp = fopen("$path$pseudo.png", 'wb');
                                curl_setopt($ch, CURLOPT_FILE, $fp);
                                curl_setopt($ch, CURLOPT_HEADER, 0);
                                curl_setopt($ch, CURLOPT_FAILONERROR, true); // Cette option permet de gérer les erreurs HTTP
                                if (!curl_exec($ch)) {
                                    // Si une erreur HTTP s'est produite (par exemple, une erreur 404), téléchargez l'image par défaut
                                    if (curl_errno($ch) == 22) {
                                        curl_close($ch);
                                        fclose($fp);
                                        $url = "https://minotar.net/helm/notch/100.png";
                                        $ch = curl_init($url);
                                        $fp = fopen("$path$pseudo.png", 'wb');
                                        curl_setopt($ch, CURLOPT_FILE, $fp);
                                        curl_setopt($ch, CURLOPT_HEADER, 0);
                                        curl_exec($ch);
                                    }
                                }
                                curl_close($ch);
                                fclose($fp);

                                // Chemin de l'image
                                $imagePath = "$path$pseudo.png";

                                // Préparez un INSERT statement pour ajouter le nouvel utilisateur à la base de données
                                $insert = $this->pdo->prepare('INSERT INTO _user(pseudo, email, password, picture_account, date_create_account, key_verify, verify_key_date, account_confirmed) VALUES(:pseudo, :email, :password, :picture_account, :date_create_account, :key_verify, :verify_key_date, :account_confirmed)');
                                $insert->execute(array(
                                    'pseudo' => $pseudo,
                                    'email' => $email,
                                    'password' => $password,
                                    'picture_account' => $imagePath, // Ajoutez ceci
                                    'date_create_account' => $date_create_account,
                                    'key_verify' => $key,
                                    'verify_key_date' => $expiry_date,
                                    'account_confirmed' => 0
                                ));

                                // Delete the image file after inserting into the database
                                // if (file_exists($imagePath)) {
                                //     unlink($imagePath);
                                // }


                                // Send an email to the user for account verification
                                GestionEmail::sendMailVerify('Confirmation de compte', $email, $key);
                                // Call the RegisterDirectWithError method of the ErrorHandler object with a 'success' parameter
                                $this->errorHandler->RegisterDirectWithError('success');
                                // Exit the script
                                exit();
                            } else {
                                // Call the RegisterDirectWithError method of the ErrorHandler object with a 'password' parameter
                                $this->errorHandler->RegisterDirectWithError('password');
                                // Exit the script
                                exit();
                            }
                        } else {
                            // Call the RegisterDirectWithError method of the ErrorHandler object with an 'email' parameter
                            $this->errorHandler->RegisterDirectWithError('email');
                            // Exit the script
                            exit();
                        }
                    } else {
                        // Call the RegisterDirectWithError method of the ErrorHandler object with an 'email_length' parameter
                        $this->errorHandler->RegisterDirectWithError('email_length');
                        // Exit the script
                        exit();
                    }
                } else {
                    // Call the RegisterDirectWithError method of the ErrorHandler object with a 'pseudo_length' parameter
                    $this->errorHandler->RegisterDirectWithError('pseudo_length');
                    // Exit the script
                    exit();
                }
            } else {
                // Call the RegisterDirectWithError method of the ErrorHandler object with an 'already' parameter
                $this->errorHandler->RegisterDirectWithError('already');
                // Exit the script
                exit();
            }
        }

        // Method to confirm a user's account
        public function confirmAccount($key) {
            // If the key parameter is not empty
            if (!empty($key)) {
                // Sanitize the key value
                $key = htmlspecialchars($key);

                // Prepare a SELECT statement to retrieve the user's information from the database
                $check = $this->pdo->prepare('SELECT pseudo, email, password, verify_key_date, account_confirmed FROM _user WHERE key_verify = ?');
                $check->execute(array($key));
                $data = $check->fetch();
                $row = $check->rowCount();

                // If the key is valid
                if ($row == 1) {
                    // If the account has already been confirmed
                    if ($data['account_confirmed'] == 1) {
                        // Call the LoginreDirectWithError method of the ErrorHandler object with a 'confirmed' parameter
                        $this->errorHandler->LoginreDirectWithError('confirmed');
                        // Exit the script
                        exit();
                    }

                    // Calculate the time difference between the current time and the key's expiry date
                    $now = new DateTime();
                    $keyDate = new DateTime($data['verify_key_date']);
                    $interval = $now->diff($keyDate);

                    // If the key is still valid
                    if ($interval->h < 2) {
                        // Update the user's account_confirmed value to 1
                        $update = $this->pdo->prepare('UPDATE _user SET account_confirmed = 1 WHERE key_verify = ?');
                        $update->execute(array($key));
                        // Call the RegistreConfirmationError method of the ErrorHandler object with a 'success' parameter
                        $this->errorHandler->RegistreConfirmationError('success');
                    } else {
                        // Send a new email verification message to the user
                        GestionEmail::sendMailVerify('Confirmation de compte', $data['email'], $key);
                        // Call the RegistreConfirmationError method of the ErrorHandler object with an 'expired' parameter
                        $this->errorHandler->RegistreConfirmationError('expired');
                    }
                } else {
                    // Call the RegistreConfirmationError method of the ErrorHandler object with an 'invalid' parameter
                    $this->errorHandler->RegistreConfirmationError('invalid');
                }
            } else {
                // Redirect the user to the registration page
                header('Location: index.php?page=register');
                // Exit the script
                exit();
            }
        }
    }