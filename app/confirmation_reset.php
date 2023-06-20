<?php
    require_once 'config.php';
    require 'PHPMailer/PHPMailer/src/Exception.php';
    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/PHPMailer/src/SMTP.php';

    $resetMessage = '';
    $resetClass = '';
    $key = '';
    if (!empty($_GET['key'])) {
        $key = htmlspecialchars($_GET['key']);
    }

    if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
        if ($_POST['password'] == $_POST['confirm_password']) {
            $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $update = $pdo->prepare('UPDATE _user SET password = ? WHERE verify_key_date IS NOT NULL AND verify_key_date >= DATE_SUB(NOW(), INTERVAL 2 HOUR)');
            $update->execute(array($hashedPassword));
            $resetMessage = 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.';
            $resetClass = 'bg-green-50 text-green-700';
        } else {
            $resetMessage = 'Les mots de passe ne correspondent pas.';
            $resetClass = 'bg-red-50 text-red-700';
        }
    }

    if (!empty($key)) {
        $check = $pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
        $check->execute(array($key));
        $data = $check->fetch();
        $row = $check->rowCount();

        if ($row == 1) {
            $now = new DateTime();
            $keyDate = new DateTime($data['verify_key_date']);
            $interval = $now->diff($keyDate);

            if ($interval->h < 2) {
                $resetMessage = 'Succes : <br>
                <a class="font-normal">Votre clé de réinitialisation est valide. Vous pouvez maintenant définir un nouveau mot de passe.</a>';
                $resetClass = 'bg-green-200 text-green-700';
            } else {
                $resetMessage = 'Warning : <br>
                <a class="font-normal">Votre clé de réinitialisation est expirée. Un nouvel email a été envoyé.</a>';
                $resetClass = 'bg-yellow-50 text-yellow-700';
            }
        } else {
            $resetMessage = 'Error: <br>
            <a class="font-normal">La clé de réinitialisation est invalide.</a>';
            $resetClass = 'bg-red-50 text-red-700';
        }
    } else {
        header('Location:connexion.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Primary Meta Tags -->
    <title>MCServerManager - Réinitialisation du mot de passe</title>
    <meta name="title" content="MCServerManager - Réinitialisation du mot de passe" />
    <meta name="description" content="Page de réinitialisation du mot de passe pour les clients de MCServerManager" />
    <meta name="keywords" content="MCServerManager, réinitialisation, mot de passe, client, panel, dashboard, espace client, espace, client, dashboard, MCServerManager, next, contains" />
    <meta name="author" content="MCServerManager" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Tags Generated with https://metatags.io -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/06dc38b1da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
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
                <img class="mx-auto h-12 w-auto" src="assets/img/logo.png" alt="MCServerManager">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Réinitialisation du mot de passe
                </h2>
            <div class="rounded-md <?php echo $resetClass; ?> p-2 mt-5">
                <div class="flex">
                    <div class="ml-3">
                        <div class="mt-2 font-semibold">
                            <p>
                                <?php echo $resetMessage; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($key)): ?>
            <form class="mt-8 space-y-6" action="confirmation_reset.php" method="POST">
                <input type="hidden" name="reset_key" value="<?php echo $key; ?>">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="w-full mb-4 relative">
                        <label class="block text-gray-800 font-medium">Mot de passe</label>
                        <i class="fas fa-lock absolute text-gray-500 left-3 top-11"></i>
                        <input class="w-full pl-8 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-[#496AC8]" type="password" placeholder="Mot de passe" name='password' required>
                    </div>
                    <div class="w-full mb-4 relative">
                        <label class="block text-gray-800 font-medium">Confirmation du mot de passe</label>
                        <i class="fas fa-lock absolute text-gray-500 left-3 top-11"></i>
                        <input class="w-full pl-8 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-[#496AC8]" type="password" placeholder="Confirmer le nouveau mot de passe" id="confirm-password" name="confirm_password" required>
                    </div>
                </div>
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Réinitialiser le mot de passe
                    </button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
