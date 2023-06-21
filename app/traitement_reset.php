<?php 
    require 'email.php';
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['email']))
    { 
        $email = htmlspecialchars($_POST['email']);

        $check = $pdo->prepare('SELECT email, password FROM _user WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1)
        {   
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $key = bin2hex(openssl_random_pseudo_bytes(32));
                $date = new DateTime();
                $date_create_account = $date -> format('Y-m-d H:i:s');
                $expiry_date = new DateTime();
                $expiry_date->add(new DateInterval('PT2H')); // PT2H means a period of time that is 2 hours long
                $reset_key = $expiry_date->format('Y-m-d H:i:s');

                $insert = $pdo->prepare('UPDATE _user SET key_verify = :key_verify, verify_key_date = :verify_key_date WHERE email = :email');
                $insert->execute(array(
                    'key_verify' => $key,
                    'verify_key_date' => $reset_key,
                    'email' => $email
                ));

                // Send the confirmation email
                GestionEmail::sendMailReset('Réinitialisation du mot de passe', $email, $key);
                header('Location: reset.php?reg_err=success');
                exit();
            }
            else{ 
                header('Location: reset.php?reg_err=emailincorrect'); exit();
            }
        }
        else{ 
            header('Location: reset.php'); exit();
        }
    }
    else
    {
        header('Location: reset.php');
        exit();
    }
?>
