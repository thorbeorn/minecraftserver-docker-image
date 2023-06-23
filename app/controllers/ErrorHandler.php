<?php
    class ErrorHandler {
        public function LoginreDirectWithError($error) {
            $errorMessages = [
                'password' => 'Mot de passe incorrect.',
                'already' => 'Utilisateur non trouvé.',
                'success' => 'Réinitialisation du mot de passe réussie !',
            ];

            $errorMessage = $errorMessages[$error] ?? 'Erreur de connexion inconnue.';

            header('Location: login.inc.php?login_err=' . $error . '&message=' . urlencode($errorMessage));
            exit();
        }

        public function RegisterDirectWithError($error) {
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


        public function RegistreConfirmationError($errorCode) {
            $errorMessage = [
                'expired' => 'Votre clé de confirmation a expiré. Un nouvel e-mail de confirmation a été envoyé.',
                'invalid' => 'La clé de confirmation est invalide.',
                'success' => 'Votre compte a été activé avec succès !'
            ];

            $errorMessage = $errorMessages[$errorCode ?? 'invalid'] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte ';

            header('Location: register-confirm.inc.php?register_err=' . $errorCode . '&message=' . urlencode($errorMessage));
            exit();
        }


        public function redirectWithResetError($error) {
            $errorMessages = [
                'email' => 'Adresse email incorrecte.',
                'notfound' => 'Utilisateur non trouvé.',
                'success' => 'Vérifiez votre email pour réinitialiser votre mot de passe.'
            ];

            $errorMessage = $errorMessages[$error] ?? 'Erreur inconnue.';

            header('Location:  index.php?page=reset-password&reset_err=' . $error . '&message=' . urlencode($errorMessage));
            exit();
        }

        public function redirectWithUpdateError($error) {
            $errorMessages = [
                'match' => 'Les mots de passe ne correspondent pas.',
                'changed' => 'Le mot de passe a déjà été modifié ou la clé de réinitialisation a expiré.',
                'success' => 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.',
                'valid' => 'Votre clé de réinitialisation est valide. Vous pouvez maintenant définir un nouveau mot de passe.',
                'expired' => 'Votre clé de réinitialisation est expirée. Un nouvel email a été envoyé.',
                'invalid' => 'La clé de réinitialisation est invalide.'
            ];

            $errorMessage = $errorMessages[$error] ?? 'Erreur inconnue.';

            header('Location: reset-password-confirm.inc.php?update_err=' . $error . '&message=' . urlencode($errorMessage));
            exit();
        }


        
        public function handleError404() {
                require_once 'views/error404.inc.php';
                exit();
        }
    }
    
?>  