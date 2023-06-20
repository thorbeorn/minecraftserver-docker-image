<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer/PHPMailer/src/Exception.php'; // On inclut la classe Exception de PHPMailer
    require './PHPMailer/PHPMailer/src/PHPMailer.php'; // On inclut la classe PHPMailer
    require './PHPMailer/PHPMailer/src/SMTP.php'; // On inclut la classe SMTP de PHPMailer
    // Send the confirmation email
    $mail = new PHPMailer;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP server (replace with your SMTP server)
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply.mcserverminecraft@gmail.com'; // SMTP username (replace with your SMTP username)
    $mail->Password = 'lvsdmrznsggkeuqf'; // SMTP password (replace with your SMTP password)
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('noreply.mcserverminecraft@gmail.com', 'Bot - McServerMinecraft'); // Sender address
    $mail->addAddress('thibaut.maurras34@gmail.com', 'Wesh'); // Add a recipient
    $mail->isHTML(true); // Set email format to HTML

    $mail->Subject = 'Account confirmation';
    $mail->Body    = 
    '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Réinitialisation de Mot de Passe</title>
        <!-- Inclure Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h2 class="card-title text-center">Réinitialisation du Mot de Passe</h2>
                            <p>Après avoir cliqué sur le bouton, vous serez invité à suivre les étapes suivantes :</p>
                            <ol>
                                <li>Saisir un nouveau mot de passe.</li>
                                <li>Confirmez votre nouveau mot de passe.</li>
                                <li>Cliquez sur Soumettre.</li>
                            </ol>
                            <a href="#" class="btn btn-primary btn-block">Réinitialisation du Mot de Passe</a>
                            <p class="text-center mt-3">Ce lien est valable pour une seule utilisation. Expire dans 2 heures.</p>
                            <p>Si vous navez pas demandé la réinitialisation de votre mot de passe, veuillez ignorer ce message ou contacter notre service clientèle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    
    ';
    $mail->AltBody = 'Please copy and paste the following link into your web browser to confirm your account: http://localhost/confirm.php?key=efzfzfozgergergeg';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
?>