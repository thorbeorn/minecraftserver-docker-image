<?php
    class ErrorHandler {
        // Gestion erreur page Login
        public function LoginreDirectWithError($error) {
            $errorMessages = [
                'password' => 'Mot de passe incorrect',
                'already' => 'Utilisateur non trouvé',
                'success' => 'Votre mot de passe a été réinitialisé avec succès'
            ];

            $errorMessage = $errorMessages[$error] ?? 'Erreur de connexion inconnue.';

            header('Location: index.php?page=login&login_err=' . $error . '&message=' . rawurlencode($errorMessage)); // Change ici
            exit();
        }

        // Gestion erreur page Registre
        public function RegisterDirectWithError($error) {
            $errorMessages = [
                'password' => 'Mot de passe différent',
                'email' => 'Email non valide',
                'email_length' => 'Email trop long',
                'pseudo_length' => 'Pseudo trop long',
                'already' => 'Compte déjà existant',
                'success' => 'Inscription réussie !, Un mail de confirmation à était envoyer.'
            ];

            $errorMessage = $errorMessages[$error ?? 'invalide'] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte.';

            header('Location: index.php?page=register&register_err=' . $error . '&message=' . rawurlencode($errorMessage));
            exit();
        }

        // Gestion erreur page Registre confirmation
        public function RegistreConfirmationError($errorCode) {
            $errorMessage = [
                'expired' => 'Votre clé de confirmation a expiré. Un nouvel e-mail de confirmation a été envoyé.',
                'invalid' => 'La clé de confirmation est invalide.',
                'success' => 'Votre compte a été activé avec succès !'
            ];

            $errorMessage = $errorMessages[$errorCode ?? 'invalid'] ?? 'Une erreur inconnue s\'est produite lors de la confirmation du compte ';
            $_SESSION['registerConfirm_err'] = $errorMessage;
            $_SESSION['registerConfirm_type'] = $errorCode;
        }

        // Gestion erreur page Reset password
        public function ResetredirectWithError($error) {
            $errorMessages = [
                'email' => 'Adresse email incorrecte.',
                'notfound' => 'Utilisateur non trouvé.',
                'success' => 'Vérifiez votre email pour réinitialiser votre mot de passe.'
            ];

            $errorMessage = $errorMessages[$error] ?? 'Erreur inconnue.';

            header('Location:  index.php?page=reset-password&reset_err=' . $error . '&message=' . rawurlencode($errorMessage));
            exit();
        }

        // Gestion erreur page Reset password confirmation
        public function ResetredirectWithUpdateError($error) {
            $errorMessages = [
                'match' => 'Les mots de passe ne correspondent pas.',
                'changed' => 'Le mot de passe a déjà été modifié ou la clé de réinitialisation a expiré.',
                'valid' => 'Votre clé de réinitialisation est valide. Vous pouvez maintenant définir un nouveau mot de passe.',
                'expired' => 'Votre clé de réinitialisation est expirée. Un nouvel email a été envoyé.',
                'invalid' => 'La clé de réinitialisation est invalide.'
            ];
        
            $errorMessage = $errorMessages[$error] ?? 'Erreur inconnue.';
            
            // Stocker le message d'erreur et le type d'erreur dans une session
            $_SESSION['reset_error'] = $errorMessage;
            $_SESSION['reset_error_type'] = $error;
        }


        // Gestion erreur page Reset password confirmation
        public function handleError404() {
                require_once 'views/error404.inc.php';
                exit();
        }
    }
    
?>  