<!DOCTYPE html>
<?php
    require_once 'config.php';


    // Récupérer les informations de l'utilisateur connecté depuis la base de données
    $stmt = $pdo->prepare('SELECT pseudo, email FROM _user WHERE pseudo = :pseudo');
    $stmt->bindParam(':pseudo', $_SESSION['user']);
    $stmt->execute();
    $user = $stmt->fetch();

?>

<html lang="fr">
    <head>
        <title>MCServerManager - Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="assets/img/icon_logo.png"/>

        <!-- Script appel API CSS/JS-->
        <script defer src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://kit.fontawesome.com/06dc38b1da.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>
    </head>

    <body>
        <header class="flex justify-between bg-[#111111]">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="/" class="flex ml-2">
                    <img src="assets/img/banner_logo.png" class="h-20 mr-3" alt="logo" />
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex items-center mr-10">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full hover:ring-gray-300 hover:ring-4" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none  divide-y rounded shadow bg-gray-700 divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-white" role="none">
                            <?php echo $user['pseudo']; ?>
                            </p>
                            <p class="text-sm font-medium  truncate text-gray-300" role="none">
                            <?php echo $user['email']; ?>
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                <i class="fa-solid fa-gear"></i>
                                Paramètre
                                </a>
                            </li>
                            <li>
                                <a href="deconnexion.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                    <i class="fa-solid fa-right-from-bracket"></i>    
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <aside class="flex flex-col flex-shrink-0 w-64 bg-gray-800 dark:bg-gray-900" id="logo-sidebar">
            <div class="flex flex-col items-center flex-shrink-0 py-4">
                <a href="/" class="flex items-center justify-center">
                    <img src="assets/img/logo.png" class="w-10 h-10" alt="logo" />
                    <span class="text-xl font-semibold text-white">MCServerManager</span>
                </a>
            </div>
            <nav class="flex-grow pb-4 pr-4 overflow-y-auto">
                <ul class="mt-6 overflow-y-auto">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                        <a href="dashboard.php" class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <i class="fa-solid fa-house"></i>
                            <span class="ml-4">Accueil</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a href="server.php" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <i class="fa-solid fa-server"></i>
                            <span class="ml-4">Serveur</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a href="plugin.php" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <i class="fa-solid fa-puzzle-piece"></i>
                            <span class="ml-4">Plugins</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a href="config.php" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <i class="fa-solid fa-cog"></i>
                            <span class="ml 4">Configuration</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3">
                        <a href="user.php" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <i class="fa-solid fa-user"></i>
                            <span class="ml-4">Utilisateur</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
    </body>
</html>