
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<div class="text-center">
    <img src="<?= Chemins::IMAGES . "logo.png"?>" alt="logo" class="w-1/2 mx-auto">
    <lottie-player src="<?= Chemins::IMAGES . "error/error-404.json"?>" background="transparent"  speed="1"  style="width: 300px; height: 300px;" loop controls autoplay></lottie-player>
    <p class="mt-4 text-xl">Désolé, la page que vous cherchez ne peut pas être trouvée.</p>
    <a href="index.php" class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Retour à l'accueil
    </a>
</div>