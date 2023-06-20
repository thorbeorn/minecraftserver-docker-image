<!DOCTYPE html>
<html>
<head>
    <title>MCServerManager - Réinitialiser le mot de passe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/06dc38b1da.js" crossorigin="anonymous"></script>
    <style>
        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        
        .gradient-background {
            background: linear-gradient(90deg, #1C59A3, #174d8a, #183663);
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
    </style>
</head>

<body class="gradient-background flex items-center justify-center h-screen">
    <div class=" shadow-2xl rounded-lg overflow-hidden bg-white shadow-[#34495E]/100">
        <div class="flex items-center justify-center m-10">
            <h1 class="text-[#1C59A3] text-3xl font-sans font-bold">Réinitialisation du mot de passe</h1>
        </div>
        <div class="px-10">
            <p class="max-w-md mb-5 text-gray-600 font-normal">Veuillez saisir votre adresse courriel. Vous recevrez un lien pour créer un nouveau mot de passe par courriel.</p>
            <form action="reset_traitement.php" method="post">
            <?php 
                    if(isset($_GET['reg_err']))
                    {
                        $err = htmlspecialchars($_GET['reg_err']);

                        switch($err)
                        {
                            case 'success':
                            ?>
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3" role="alert">
                                    <strong class="font-bold">Succès</strong>
                                    <span class="block sm:inline">Envoie du mail de réinitialisation de mot de passe</span>
                                </div>
                            <?php
                            break;

                            case 'email':
                            ?>
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-3" role="alert">
                                    <strong class="font-bold">Erreur</strong>
                                    <span class="block sm:inline">Email inconnu</span>
                                </div>
                            <?php
                            break;

                        }
                    }
                ?>
                <div class="w-full mb-4 relative">
                    <label class="block text-gray-800 font-medium">Adresse courriel</label>
                    <i class="fa-solid fa-envelope absolute text-gray-500 left-3 top-11"></i>
                    <input class="w-full pl-8 pr-3 py-2 mt-2 border rounded-lg focus:outline-none focus:border-[#496AC8]" name="email" type="email" placeholder="exemple@gmail.com" required>
                </div>
                <button type="submit" class="w-full bg-[#1C59A3] text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-5">Envoyer le lien de réinitialisation</button>
            </form>
            <div class="flex items-center justify-center bg-gray-100 text-gray-500 px-10 py-6 border-t border-gray-200">
                <a href="/" class="text-[#1C59A3] hover:text-blue-920 hover:underline font-bold">Retourner à la page de connexion</a>
            </div>
        </div>
    </div>
</body>
</html>
