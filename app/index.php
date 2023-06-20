<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Primary Meta Tags -->
    <title>MCServerManager - Page de Connexion</title>
    <meta name="title" content="MCServerManager - Page de Connexion" />
    <meta name="description" content="Pour les clients de MCServerManager qui souhaite se connecter à leur panel" />
    <meta name="keywords" content="MCServerManager, connexion, client, panel, dashboard, espace client, espace, client, dashboard, panel, MCServerManager, next, contains" />
    <meta name="author" content="MCServerManager" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon_logo.png"/>

    <!-- Meta Tags Generated with https://metatags.io -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/06dc38b1da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
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
<body class="gradient-background flex flex-col items-center justify-center h-screen">
    <div class="shadow-2xl rounded-lg overflow-hidden bg-white shadow-[#34495E]/100">
        <div class="flex items-center justify-center m-10">
            <h1 class="text-[#1C59A3] text-3xl font-sans font-bold">Connexion</h1>
        </div>
        <div class="px-10" >
            <form action="connexion.php" method="post">
                <?php 
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);

                        switch($err)
                        {
                            case 'password':
                            ?>
                                <div class="bg-red-500 text-white p-3 rounded mb-3">
                                    <strong>Erreur</strong> : Mot de passe incorrect
                                </div>
                            <?php
                            break;

                            case 'already':
                            ?>
                                <div class="bg-red-500 text-white p-3 rounded mb-3">
                                    <strong>Erreur</strong> : Utilisateur non existant
                                </div>
                            <?php
                            break;
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
                    <a href="reset.php" class="text-[#196F3D hover:text-blue-920 hover:underline font-normal">Mot de passe oublié ?</a>
                </div>
                <button class="w-full bg-[#1C59A3] text-white py-2 rounded-lg hover:bg-[#0E2C52] mb-2 font-semibold">Connexion</button>
            </form>
        </div>
        <div>
            <div class="flex items-center justify-center bg-gray-100 text-gray-700 px-10 py-6 border-t border-gray-200">
                <span class="mr-2">Vous n'avez pas de compte ?</span>
                <a href="inscription.php" class="text-[#1C59A3] hover:text-blue-920 hover:underline font-bold">Inscrivez-vous</a>
            </div>
        </div>
    </div>
</body>
</html>
