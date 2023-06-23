<?php 
    $confirmMessage = '';
    $confirmClass = '';

    if(isset($_GET['confirmMessage']) && isset($_GET['confirmClass'])) {
        $confirmMessage = htmlspecialchars($_GET['confirmMessage']);
        $confirmClass = htmlspecialchars($_GET['confirmClass']);
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
