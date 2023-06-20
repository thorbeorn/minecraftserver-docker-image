<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/PHPMailer/src/Exception.php'; // On inclut la classe Exception de PHPMailer
    require 'PHPMailer/PHPMailer/src/PHPMailer.php'; // On inclut la classe PHPMailer
    require 'PHPMailer/PHPMailer/src/SMTP.php'; // On inclut la classe SMTP de PHPMailer
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

                            // Send the confirmation email
                            $mail = new PHPMailer;
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com'; // SMTP server (replace with your SMTP server)
                            $mail->SMTPAuth = true;
                            $mail->Username = 'noreply.mcserverminecraft@gmail.com'; // SMTP username (replace with your SMTP username)
                            $mail->Password = 'lvsdmrznsggkeuqf'; // SMTP password (replace with your SMTP password)
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;

                            $mail->setFrom('noreply.mcserverminecraft@gmail.com', 'Mailer'); // Sender address
                            $mail->addAddress($email, $pseudo); // Add a recipient
                            $mail->isHTML(true); // Set email format to HTML

                            $mail->Subject = 'Account confirmation';
                            $mail->Body    = '
                            <!DOCTYPE html>
                            <html>
                            <head>
                                <title>Vérification de compte</title>
                                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                            </head>
                            <body>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header text-center"><h4>Vérification de compte</h4></div>
                                                <div class="card-body">
                                                    <p class="lead">Bienvenue !</p>
                                                    <p class="lead">Merci de créer un compte.</p>
                                                    <p class="lead">Cliquez sur le bouton ci-dessous pour vérifier votre compte :</p>
                                                    <a href="http://localhost:9000/confirmation.php?key=' . $key . '" class="btn btn-primary btn-block">Vérifier le compte</a>
                                                    <p class="text-muted mt-5">Ce lien est valable pour une seule utilisation. Expire dans 24 heures.</p>
                                                    <p class="text-muted">Si vous n avez pas créé de compte, veuillez ignorer ce message ou contacter notre service clientèle.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </body>
                            </html>
                            ';
                            $mail->AltBody = 'Please copy and paste the following link into your web browser to confirm your account: http://localhost:9000/confirmation.php?key=' . $key . '';

                            $mail->send();
                            // Check if the email was sent
                            if($mail->send()) {
                                // If the email was sent, redirect
                                header('Location: inscription.php?reg_err=success');
                                die();
                            } else {
                                // If the email was not sent, output an error message
                                echo 'Message could not be sent.';
                                echo 'Mailer Error: ' . $mail->ErrorInfo;
                            }


                            die();
                        }else{ header('Location: inscription.php?reg_err=password'); die();}
                    }else{ header('Location: inscription.php?reg_err=email'); die();}
                }else{ header('Location: inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: inscription.php?reg_err=already'); die();}
    }
?>