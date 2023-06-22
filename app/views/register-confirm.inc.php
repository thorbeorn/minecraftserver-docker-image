
<?php
require_once 'config.php'; // On inclut la connexion à la base de données
require_once 'ErrorHandler.php'; // On inclut la classe ErrorHandler

$confirmMessage = '';
$confirmClass = '';

if (!empty($_GET['key'])) {
    $key = htmlspecialchars($_GET['key']);

    $registerController = new RegisterController(); // Crée une instance du contrôleur RegisterController
    $result = $registerController->confirmAccount($key); // Appelle la méthode confirmAccount pour vérifier et confirmer le compte

    // Si la méthode confirmAccount retourne true, l'activation du compte a réussi
    $registerErr = $_GET['register_err'] ?? '';
    $message = $_GET['message'] ?? '';
    
    // On définit le message à afficher et la classe du message en fonction de la valeur de $registerErr
    if ($registerErr === 'success') {
        $confirmMessage = $message;
        $confirmClass = 'bg-green-50 text-green-700';
    } elseif ($registerErr === 'expired') {
        $confirmMessage = $message;
        $confirmClass = 'bg-yellow-50 text-yellow-700';
    } elseif ($registerErr === 'invalid') {
        $confirmMessage = $message;
        $confirmClass = 'bg-red-50 text-red-700';
    } else {
        // Erreur inconnue, afficher un message générique
        $confirmMessage = 'Une erreur inconnue s\'est produite lors de la confirmation du compte.';
        $confirmClass = 'bg-red-50 text-red-700';
    }
} else {
    header('Location: register.inc.php');
    die();
}
?>

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
                        <?php echo htmlspecialchars($confirmMessage); ?>
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
