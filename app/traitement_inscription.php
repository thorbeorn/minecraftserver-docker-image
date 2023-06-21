<?php 

    require_once 'email.php';
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        $check = $pdo->prepare('SELECT pseudo, email, password FROM _user WHERE pseudo = ?');
        $check->execute(array($pseudo));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); 

        if($row == 0){ 
            if(strlen($pseudo) <= 255){
                if(strlen($email) <= 50){
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                        if($password === $password_retype){ 

                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                            // Generate random key
                            $key = bin2hex(openssl_random_pseudo_bytes(32));
                            $date = new DateTime();
                            $date_create_account = $date -> format('Y-m-d H:i:s');
                            $expiry_date = new DateTime();
                            $expiry_date->add(new DateInterval('PT2H')); // PT2H means a period of time that is 2 hours long
                            $expiry_date = $expiry_date->format('Y-m-d H:i:s');


                            $insert = $pdo->prepare('INSERT INTO _user(pseudo, email, password, date_create_account, key_verify, verify_key_date, account_confirmed) VALUES(:pseudo, :email, :password, :date_create_account, :key_verify, :verify_key_date, :account_confirmed)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'date_create_account' => $date_create_account, // here we add the new value
                                'key_verify' => $key,
                                'verify_key_date' => $expiry_date,
                                'account_confirmed' => intval(0)
                            ));

                            GestionEmail::sendMailVerify('Confirmation de compte', $email, $key);
                            // If the email was sent, redirect
                            header('Location: inscription.php?reg_err=success');
                            exit();

                        }else{ header('Location: inscription.php?reg_err=password'); exit();}
                    }else{ header('Location: inscription.php?reg_err=email'); exit();}
                }else{ header('Location: inscription.php?reg_err=email_length'); exit();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); exit();}
        }else{ header('Location: inscription.php?reg_err=already'); exit();}
    }
?>