<?php
    require_once Chemins::CONTROLEURS . 'LoginController.php'; // Assurez-vous que le chemin vers le fichier LoginController.php est correct
    $LoginController = new LoginController();

    if (htmlspecialchars($_SERVER["REQUEST_METHOD"] == "POST")) {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $LoginController->loginUser($pseudo, $password);
    }
?>

<div class="flex items-center justify-center mt-10 mb-5">
    <img class="mx-auto h-12 w-auto" src="<?= Chemins::IMAGES . 'logo.png'; ?>" alt="MCServerManager">
</div>
<h1 class="text-[#1C59A3] text-3xl font-sans font-bold text-center mb-10">Connexion</h1>
<div class="px-10" >
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>" method="post">
        <?php 
            if(isset($_GET['login_err']))
            {
                $err = htmlspecialchars($_GET['login_err']);
                $message = htmlspecialchars(rawurldecode($_GET['message']));
                if ($err === 'password' or $err === 'already') {
        ?>
                    <div class="bg-red-500 text-white p-3 rounded mb-3">
                        <strong>Erreur</strong> : <?= $message ?>
                    </div>
        <?php
                } 
                elseif ($err === 'success') {
        ?>
                    <div class="bg-green-700 text-white p-3 rounded mb-3">
                        <strong>Succès</strong> : <?= $message ?>
                    </div>

        <?php
                }
            }
        ?>
        <div class="w-full mb-3 relative">
            <label class="block text-gray-800 font-medium">Nom d'utilisateur</label>
            <i class="fas fa-user absolute text-gray-500 left-3 top-11"></i>
            <input class="w-full pl-8 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-[#496AC8]" type="text" placeholder="Nom d'utilisateur" name='pseudo' required>
        </div>
        <div class="w-full mb-4 relative">
            <label class="block text-gray-800 font-medium">Mot de passe</label>
            <i class="fas fa-lock absolute text-gray-500 left-3 top-11"></i>
            <input class="w-full pl-8 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-[#496AC8]" type="password" placeholder="Mot de passe" name='password' required>
        </div>
        <div class="flex items-center justify-between mb-4">
            <a href="index.php?page=reset-password" class="text-[#196F3D hover:text-blue-920 hover:underline font-normal">Mot de passe oublié ?</a>
        </div>
        <button class="w-full bg-[#1C59A3] text-white py-2 rounded-lg hover:bg-[#0E2C52] mb-2 font-semibold">Connexion</button>
    </form>
</div>
<div>
    <div class="flex items-center justify-center bg-gray-100 text-gray-700 px-10 py-6 border-t border-gray-200">
        <span class="mr-2">Vous n'avez pas de compte ?</span>
        <a href="index.php?page=register" class="text-[#1C59A3] hover:text-blue-920 hover:underline font-bold">Inscrivez-vous</a>
    </div>
</div>