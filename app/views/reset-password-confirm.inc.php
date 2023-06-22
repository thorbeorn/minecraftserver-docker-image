<?php
    require_once 'config.php';
    
    $key = $_GET['key'] ?? '';
    $key = htmlspecialchars($key);

    if ($key == '') {
        redirectAndExit('index.php');
    }

    $resetMessage = '';
    $resetClass = '';

    if (passwordsArePostedAndMatch()) {
        updatePassword($key);
        setSuccess('Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
    } else if (!empty($_POST['password']) || !empty($_POST['confirm_password'])) {
        setError('Les mots de passe ne correspondent pas.');
    }

    validateKey($key);

    function passwordsArePostedAndMatch(): bool {
        return (!empty($_POST['password']) && !empty($_POST['confirm_password']) && $_POST['password'] == $_POST['confirm_password']);
    }

    function updatePassword(string $key): void {
        global $pdo;

        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = $pdo->prepare('UPDATE _user SET password = ? WHERE verify_key_date IS NOT NULL AND verify_key_date >= DATE_SUB(NOW(), INTERVAL 2 HOUR) AND key_verify = ?');
        $update->execute([$hashedPassword, $key]);
    }

    function validateKey(string $key): void {
        global $pdo;

        $check = $pdo->prepare('SELECT pseudo, email, password, verify_key_date FROM _user WHERE key_verify = ?');
        $check->execute([$key]);
        $data = $check->fetch();

        if ($check->rowCount() == 1) {
            if (keyIsNotExpired($data['verify_key_date'])) {
                setSuccess('Votre clé de réinitialisation est valide. Vous pouvez maintenant définir un nouveau mot de passe.');
            } else {
                setWarning('Votre clé de réinitialisation est expirée. Un nouvel email a été envoyé.');
            }
        } else {
            setError('La clé de réinitialisation est invalide.');
        }
    }

    function keyIsNotExpired(string $keyDate): bool {
        $now = new DateTime();
        $keyDate = new DateTime($keyDate);
        $interval = $now->diff($keyDate);

        return ($interval->h < 2);
    }

    function setError(string $message): void {
        global $resetMessage, $resetClass;

        $resetMessage = $message;
        $resetClass = 'bg-red-50 text-red-700';
    }

    function setWarning(string $message): void {
        global $resetMessage, $resetClass;

        $resetMessage = $message;
        $resetClass = 'bg-yellow-50 text-yellow-700';
    }

    function setSuccess(string $message): void {
        global $resetMessage, $resetClass;

        $resetMessage = $message;
        $resetClass = 'bg-green-50 text-green-700';
    }

    function redirectAndExit(string $url): void {
        header("Location: $url");
        die();
    }
?>

<div class="max-w-md w-full space-y-10">
    <div class="m-10">
        <div>
            <img class="mx-auto h-12 w-auto" src="assets/img/logo.png" alt="MCServerManager">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Réinitialisation du mot de passe
            </h2>
            <?php if (!empty($resetMessage)): ?>
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
            <?php endif; ?>
            <?php if (!empty($key)): ?>
                <form class="mt-8 space-y-6" action="content_confirmation_reset.php" method="POST">
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
</div>
