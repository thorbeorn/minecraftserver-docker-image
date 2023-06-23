<?php
    require_once Chemins::CONTROLEURS . 'ResetPasswordController.php'; // Assurez-vous que le chemin vers le fichier ResetPasswordController.php est correct
    $resetPasswordController = new ResetPasswordController();
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $key = htmlspecialchars($_GET['key'], ENT_QUOTES, 'UTF-8');
        $resetPasswordController->validateKey($key);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $key = htmlspecialchars($_POST['reset_key'], ENT_QUOTES, 'UTF-8');
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $resetPasswordController->resetConfirmPassword($key, $password, $confirm_password);
    }

    $resetMessage = '';
    $resetClass = 'bg-red-100'; // default to red for errors
    if (isset($_SESSION['reset_error'])) {
        $resetMessage = $_SESSION['reset_error'];
    
        // Vous devrez également enregistrer le type d'erreur dans la session pour pouvoir le récupérer ici
        $resetErrorType = $_SESSION['reset_error_type'];
    
        switch ($resetErrorType) {
            case 'match':
            case 'changed':
            case 'invalid':
                $resetClass = 'bg-red-100 text-red-700'; // red for error
                break;
            case 'valid':
                $resetClass = 'bg-green-100 text-green-700'; // green for success
                break;
            case 'expired':
                $resetClass = 'bg-yellow-100 text-yellow-700'; // yellow for warning
                break;
        }
        // N'oubliez pas de supprimer les messages d'erreur de la session après les avoir affichés
        unset($_SESSION['reset_error'], $_SESSION['reset_error_type']);
    }

?>

<div class="max-w-md w-full space-y-10">
    <div class="m-10">
        <div>
            <img class="mx-auto h-12 w-auto" src="<?= Chemins::IMAGES . 'logo.png'; ?>" alt="MCServerManager">
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
                <form class="mt-8 space-y-6" method="POST">
                    <input type="hidden" name="reset_key" value="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">
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