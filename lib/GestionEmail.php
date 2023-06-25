<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require_once 'vendor/autoload.php';
/**
 * Classe utilisant PHPMailer ayant pour but de gérer l'envoi de mail.
 * @package https://github.com/PHPMailer/PHPMailer
 */
class GestionEmail {

    /**
     * Méthode statique permettant d'envoyer un e-mail pour le formulaire de contact.
     * 
     * @param string $subject Sujet de l'email
     * @param string $recipient Destinataire de l'e-mail
     * @param string $key Clé de vérification
     */
    public static function sendMailVerify($subject, $recipient, $key) {
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server (replace with your SMTP server)
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply.mcserverminecraft@gmail.com'; // SMTP username (replace with your SMTP username)
            $mail->Password = 'lvsdmrznsggkeuqf'; // SMTP password (replace with your SMTP password)
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;


            $mail->setFrom("noreply.mcserverminecraft@gmail.com", "Administrateur | McServerManager");
            $mail->addAddress($recipient);

            $mail->isHTML(true);
            $mail->Subject = "Subject : " . $subject;
            $mail->Body = '
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
                                    <a href="http://localhost:9000/index.php?page=register-confirm&key=' . $key . '" class="btn btn-primary btn-block">Vérifier le compte</a>
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
            $mail->send();
        } catch (Exception $ex) {
           echo 'Message could not be sent.';

            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    /**
     * Méthode statique permettant d'envoyer un e-mail pour envoyer un code OTP pour réinitialize le mot de passe.
     * 
     * @param string $recipient Destinataire de l'e-mail
     * @param string $otpCode Le code OTP générer aléatoirement
     */
    public static function sendMailReset($subject, $recipient, $key) {
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server (replace with your SMTP server)
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply.mcserverminecraft@gmail.com'; // SMTP username (replace with your SMTP username)
            $mail->Password = 'lvsdmrznsggkeuqf'; // SMTP password (replace with your SMTP password)
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;


            $mail->setFrom("noreply.mcserverminecraft@gmail.com", "Administrateur | McServerManager");
            $mail->addAddress($recipient);

            $mail->isHTML(true);
            $mail->Subject = "Subject : " . $subject;
            $mail->Body = '
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
            
                                    <a href="http://localhost:9000/index.php?page=reset-password-confirm&key='. $key .'" class="btn btn-primary btn-block">Réinitialiser le mot de passe</a>
            
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
            $mail->send();
        } catch (Exception $ex) {
           echo 'Message could not be sent.';

            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }


}

?>