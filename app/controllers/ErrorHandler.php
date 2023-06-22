<?php

    function LoginreDirectWithError($error) {
        $errorMessages = [
            'password' => 'Mot de passe incorrect.',
            'already' => 'Utilisateur non trouvé.'
        ];

        $errorMessage = $errorMessages[$error] ?? 'Erreur de connexion inconnue.';

        header('Location: login.inc.php?login_err=' . $error . '&message=' . urlencode($errorMessage));
        exit();
    }

    function RegisterDirectWithError($error) {
        $errorMessages = [
            'password' => 'Mot de passe différent.',
            'email' => 'Email non valide.',
            'email_length' => 'Email trop long.',
            'pseudo_length' => 'Pseudo trop long.',
            'already' => 'Compte déjà existant.'
        ];

        $errorMessage = $errorMessages[$error] ?? 'Erreur d\'inscription inconnue.';

        header('Location: register.inc.php?register_err=' . $error . '&message=' . urlencode($errorMessage));
        exit();
    }

    function RegisterDirectWithSuccess($success) {
        $successMessages = [
            'success' => 'Inscription réussie !, veuillez activer votre compte via le mail que nous vous avons envoyé.'
        ];

        $successMessage = $successMessages[$success];

        header('Location: register.inc.php?register_err=' . $success . '&message=' . urlencode($successMessage));
        exit();
    }

    function RegistreConfirmationError($errorCode) {
        switch ($errorCode) {
            case 'success':
                return array('message' => 'Votre compte a été confirmé avec succès. Vous pouvez maintenant vous connecter.', 'class' => 'bg-green-50 text-green-700');
                break;
            case 'expired':
                return array('message' => 'Votre clé de confirmation a expiré. Un nouvel e-mail de confirmation a été envoyé.', 'class' => 'bg-yellow-50 text-yellow-700');
                break;
            case 'invalid':
                return array('message' => 'La clé de confirmation est invalide.', 'class' => 'bg-red-50 text-red-700');
                break;
            default:
                return array('message' => 'Une erreur inconnue s\'est produite lors de la confirmation du compte.', 'class' => 'bg-red-50 text-red-700');
                break;
        }
        $errorMessages = [
            'success' => 'Mot de passe différent.',
            'expired' => 'Email non valide.',
            'invalid' => 'Email trop long.',
        ];

        $errorMessage = $errorMessages[$error] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte ';

        header('Location: register-confirm.inc.php?register_err=' . $error . '&message=' . urlencode($errorMessage));
        exit();
    }
?>  