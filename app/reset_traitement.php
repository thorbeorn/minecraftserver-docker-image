<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer/PHPMailer/src/Exception.php'; // On inclut la classe Exception de PHPMailer
    require './PHPMailer/PHPMailer/src/PHPMailer.php'; // On inclut la classe PHPMailer
    require './PHPMailer/PHPMailer/src/SMTP.php'; // On inclut la classe SMTP de PHPMailer
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
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // SMTP server (replace with your SMTP server)
                $mail->SMTPAuth = true;
                $mail->Username = 'noreply.mcserverminecraft@gmail.com'; // SMTP username (replace with your SMTP username)
                $mail->Password = 'lvsdmrznsggkeuqf'; // SMTP password (replace with your SMTP password)
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                // Configuration des destinataires
                $mail->setFrom('noreply.mcserverminecraft@gmail.com', 'Bot - McServerMinecraft');
                $mail->addAddress($email); 

                // Contenu du mail
                $mail->isHTML(true); 
                $mail->Subject = 'Reinitialisation du mot de passe';
                $mail->Body    = '
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Réinitialisation du mot de passe</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                </head>
                <body>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header text-center"><h4>Réinitialisation du mot de passe</h4></div>
                
                                    <div class="card-body">
                                        <p class="lead">Après avoir cliqué sur le bouton, vous serez invité à suivre les étapes suivantes :</p>
                                        <ol>
                                            <li>Saisir un nouveau mot de passe.</li>
                                            <li>Confirmez votre nouveau mot de passe.</li>
                                            <li>Cliquez sur Soumettre.</li>
                                        </ol>
                
                                        <p class="lead">Réinitialisation du mot de passe</p>
                
                                        <a href="http://localhost:9000/confirmation_reset.php?key='. $key .'" class="btn btn-primary btn-block">Réinitialiser le mot de passe</a>
                
                                        <p class="text-muted mt-5">Ce lien est valable pour une seule utilisation. Expire dans 2 heures.</p>
                                        <p class="text-muted">Si vous n avez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer ce message ou contacter notre service clientèle.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                </html>
                ';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                // Check if the email was sent
                if($mail->send()) {
                    // If the email was sent, redirect
                    header('Location: reset.php?reg_err=success');
                    die();
                } else {
                    // If the email was not sent, output an error message
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    die();
                }
            } //This closing bracket was missing
            else{ 
                header('Location: reset.php?reg_err=emailincorrect'); die();
            }
        }
        else{ 
            header('Location: reset.php'); die();
        }
    }
    else
    {
        header('Location: reset.php');
        die();
    }
?>
