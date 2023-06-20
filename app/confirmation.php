<!DOCTYPE html>
<?php
    require_once 'config.php'; // On inclut la connexion à la base de données
    require 'PHPMailer/PHPMailer/src/Exception.php'; // On inclut la classe Exception de PHPMailer
    require 'PHPMailer/PHPMailer/src/PHPMailer.php'; // On inclut la classe PHPMailer
    require 'PHPMailer/PHPMailer/src/SMTP.php'; // On inclut la classe SMTP de PHPMailer
    $confirmMessage = '';
    $confirmClass = '';

    if(!empty($_GET['key'])) {
        $key = htmlspecialchars($_GET['key']);

        $check = $pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
        $check->execute(array($key));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row == 1){
            $now = new DateTime();
            $keyDate = new DateTime($data['verify_key_date']);
            $interval = $now->diff($keyDate);

            if ($interval->h < 2) {
                $update = $pdo->prepare('UPDATE _user SET account_confirmed = 1 WHERE key_verify = ?');
                $update->execute(array($key));
                $confirmMessage = 'Votre compte a été confirmé avec succès. Vous pouvez maintenant vous connecter.';
                $confirmClass = 'bg-green-50 text-green-700';
            } else {
                // Key is no longer valid, send a new confirmation email
                $confirmMessage = 'Votre clé de confirmation est expirée. Un nouvel email a été envoyé.';
                $confirmClass = 'bg-yellow-50 text-yellow-700';
            }
        } else {
            $confirmMessage = 'La clé de confirmation est invalide.';
            $confirmClass = 'bg-red-50 text-red-700';
        }
    } else {
        header('Location:inscription.php');
        die();
    }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCServerManager - Confirmation de compte</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon_logo.png"/>
    <style>
        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        
        .gradient-background {
            background: linear-gradient(90deg, #1C59A3, #174d8a, #183663);
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
    </style>
</head>
<body class="gradient-background flex flex-col items-center justify-center h-screen">
    <div class="shadow-2xl rounded-lg overflow-hidden bg-white shadow-[#34495E]/100 p-10">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="assets/img/logo.png" alt="Logo">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Confirmation de votre compte
                </h2>
            </div>
            <div class="rounded-md <?php echo $confirmClass; ?> p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium">
                            Confirmation
                        </h3>
                        <div class="mt-2 text-sm">
                            <p>
                                <?php echo $confirmMessage; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <a href="/" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Connectez-vous à votre compte
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
