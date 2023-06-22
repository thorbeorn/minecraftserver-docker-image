<?php

    function LoginreDirectWithError($error) {
        $errorMessages = [
            'password' => 'Mot de passe incorrect.',
            'already' => 'Utilisateur non trouvé.'
            'success' => 'Reinitialisation du mot de passe réussie !'

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
            'already' => 'Compte déjà existant.',
            'success' => 'Inscription réussie !, veuillez activer votre compte via le mail que nous vous avons envoyé.'
        ];

        $errorMessage = $errorMessages[$error ?? 'invalide'] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte.';

        header('Location: register.inc.php?register_err=' . $error . '&message=' . urlencode($errorMessage));
        exit();
    }


    function RegistreConfirmationError($errorCode) {
        $errorMessage = [
            'expired' => 'Votre clé de confirmation a expiré. Un nouvel e-mail de confirmation a été envoyé.',
            'invalid' => 'La clé de confirmation est invalide.',
            'success' => 'Votre compte a été activé avec succès !'
        ]

        $errorMessage = $errorMessages[$errorCode ?? 'invalid'] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte ';

        header('Location: register-confirm.inc.php?register_err=' . $errorCode . '&message=' . urlencode($errorMessage));
        exit();
    }
?>  