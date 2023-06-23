<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<div class="max-w-md w-full space-y-10 p-5 text-center">
    <img class="mx-auto h-12 w-auto mt-3" src="<?= Chemins::IMAGES . 'logo.png'; ?>" alt="Logo de MCServerManager">
    <div class="flex justify-center ">
        <lottie-player src="<?= Chemins::IMAGES . 'error/error-404.json'?>"  background="transparent" speed="1" loop autoplay aria-role="alert" aria-label="Erreur 404"></lottie-player>
    </div>
    <p class="text-normal text-gray-600">Désolé, la page que vous cherchez ne peut pas être trouvée.</p><br>
    <a href="index.php?page=login" class="mt-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 ease-in-out">
        Retour à l'accueil
    </a>
</div>
