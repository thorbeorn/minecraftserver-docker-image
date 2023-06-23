<?php 
    require_once Chemins::CONTROLEURS . 'RegisterController.php'; // Assurez-vous que le chemin vers le fichier ResetPasswordController.php est correct
    $RegisterController = new RegisterController(); 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $key = $_GET['key'];
        $RegisterController->confirmAccount($key);
    }
    
    $confirmMessage = '';
    $resetMessage = '';
    $confirmClass = 'bg-red-100'; // default to red for errors
    if (isset($_SESSION['registerConfirm_err'])) {
        $confirmMessage = $_SESSION['registerConfirm_err'];
    
        // Vous devrez également enregistrer le type d'erreur dans la session pour pouvoir le récupérer ici
        $registerConfirm_type = $_SESSION['registerConfirm_type'];
    
        switch ($registerConfirm_type) {
            case 'invalid':
                $confirmClass = 'bg-red-100 text-red-700'; // red for error
                break;
            case 'success':
                $confirmClass = 'bg-green-100 text-green-700'; // green for success
                break;
            case 'expired':
                $confirmClass = 'bg-yellow-100 text-yellow-700'; // yellow for warning
                break;
        }
        // N'oubliez pas de supprimer les messages d'erreur de la session après les avoir affichés
        unset($_SESSION['registerConfirm_err'], $_SESSION['registerConfirm_type']);
    }
?>
<div class="max-w-md w-full space-y-8 p-6">
    <div>
        <img class="mx-auto h-12 w-auto" src="<?= Chemins::IMAGES . 'logo.png'; ?>" alt="Logo">
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
            <a href="index.php?page=login" class="font-medium text-indigo-600 hover:text-indigo-500">
                Connectez-vous à votre compte
            </a>
        </div>
    </div>
</div>
