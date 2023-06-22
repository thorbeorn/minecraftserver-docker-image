<div class="flex items-center justify-center mt-10 mb-5">
    <img class="mx-auto h-12 w-auto" src="assets/img/logo.png" alt="MCServerManager">
</div>
<h1 class="text-[#1C59A3] text-3xl font-sans font-bold text-center mb-10">Inscription</h1>
<div class="px-10">
    <form action="traitement_inscription.php" method="post">
        <?php 
            if(isset($_GET['reg_err']))
            {
                $err = htmlspecialchars($_GET['reg_err']);
                $message = htmlspecialchars(urldecode($_GET['message']));

                $alertClass = ($err === 'success') ? 'green' : 'red';
            }    
        ?>
        <div class="bg-<?= $alertClass ?>-100 border border-<?= $alertClass ?>-400 text-<?= $alertClass ?>-700 px-4 py-3 rounded relative mb-3" role="alert">
            <strong class="font-bold"><?= $err === 'success' ? 'Succès' : 'Erreur' ?></strong>
            <span class="block sm:inline"><?= $message ?></span>
        </div>

        <h2 class="text-gray-800 font-bold mb-2">Informations personnelles</h2>
        <div class="flex gap-x-2 gap-y-4 sm:gap-x-4 sm:gap-y-8 mb-2 sm:mb-4">
            <div class="w-full">
                <label class="block text-gray-800 font-normal">Nom d'utilisateur<a class="text-red-600 font-bold">*</a></label>
                <input class="w-full pl-2 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-blue-300" type="text" placeholder="Nom d'utilisateur" name="pseudo" required>
            </div>
        </div>
        <div class="flex gap-x-2 gap-y-4 sm:gap-x-4 sm:gap-y-8 mb-2 sm:mb-4">
            <div class="w-full">
                <label class="block text-gray-800 font-normal">Adresse courriel <a class="text-red-600 font-bold">*</a></label>
                <input class="w-full pl-2 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-blue-300" type="email" name="email" placeholder="Adresse courriel" required>
            </div>
        </div>

        <h2 class="text-gray-800 font-bold mb-2">Sécurité du compte</h2>
        <div class="w-full mb-4">
            <label class="block text-gray-800 font-normal">Mot de passe <a class="text-red-600 font-bold">*</a></label>
            <input class="w-full pl-2 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-blue-300" type="password" name="password" placeholder="au moins 5 caractères" required>
        </div>
        <div class="w-full mb-4">
            <label class="block text-gray-800 font-normal">Confirmer le mot de passe <a class="text-red-600 font-bold">*</a></label>
            <input class="w-full pl-2 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-blue-300" type="password" name="password_retype" placeholder="Confirmer le mot de passe" required>
        </div>
        <div class="flex items-center mb-4">
            <input id="terms-checkbox" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded  focus:ring-2" required>
            <label for="terms-checkbox" class="ml-2 text-black">J'ai lu et j'accepte les <a href="condition.php" class="text-blue-600 underline">Conditions d'utilisation <a class="text-red-600 font-bold">*</a></a></label>
        </div>
        <button type="submit" class="w-full bg-[#1C59A3] text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-5">S'inscrire</button>
    </form>
    <div class="flex items-center justify-center bg-gray-100 text-gray-500 px-10 py-6 border-t border-gray-200">
        <span class="mr-2">Déjà inscrit ?</span>
        <a href="connexion.php" class="text-[#496AC8] hover:text-blue-920 hover:underline font-bold">Se connecter</a>
    </div>
</div>