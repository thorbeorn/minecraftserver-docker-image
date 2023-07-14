<?php
    require_once 'configs/routes.class.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MCServerManager - Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="public/assets/img/icon_logo.png" />
    <!-- CSS -->
    <link href="public/assets/css/output.css" rel="stylesheet">
    <link href="public/assets/css/style.css" rel="stylesheet">
    <link href="public/assets/css/font.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= Chemins::JS_BUILD . 'elFinder/css/elfinder.min.cs' ?>">
</head>

<body class="flex flex-col h-screen">

    <!-- Header -->
    <header class="flex justify-between dark:bg-[#2e3440] bg-[#D8DEE9]">
        <div class="flex items-center justify-start">
            <button id="aside-toggle" class="ml-4 mr-2 dark:text-white text-[#2E3440] visible lg:invisible">
                <i class="fas fa-bars"></i>
            </button>
            <a href="/" class="flex items-center">
                <img src="public/assets/img/logo_solo.png" class="h-10" alt="logo"  id="logo"/>
            </a>
            <h1 class="dark:text-white text-[#2E3440] font-bold ml-2 lg:block hidden" style="font-family: 'Century Gothic', sans-serif;">
                MCServerManager
            </h1>
        </div>
        

        <div class="flex items-center">
            <div class="flex items-center space-x-5 mr-5">
                <button type="button" class="flex items-center dark:text-[#ECEFF4] text-[#434C5E] rounded p-2 font dark:hover:text-[#81A1C1] font-semibold space-x-2 hover:text-[#81A1C1]">
                    <i class="fas fa-envelope-open-text"></i>
                    <span class="hover:underline-offset-4 text-normal lg:block hidden">Support</span>
                </button>
                <div class="flex items-center space-x-7 mr-5">
                    <button id="modeToggle" type="button" class="flex items-center rounded p-2 font dark:text-[#ECEFF4] text-[#434C5E] dark:hover:text-[#81A1C1] hover:text-[#81A1C1] font-semibold">
                        <i id="icon" class="fa-solid fa-sun"></i>
                    </button>
                </div>

                <button type="button"
                    class="flex text-sm dark:bg-[#2E3440] bg-[#D8DEE9] rounded-full ring-[#202227] ring-4 m-4 dark:focus:ring-[#81A1C1] focus:ring-[#3B4252]" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
            </div>

            <div class="z-50 hidden my-4 text-base list-none  divide-y rounded shadow dark:bg-[#202227] bg-[#D8DEE9] divide-gray-700"
                id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm dark:text-[#D8DEE9] text-[#434C5E]" role="none">
                        Nom
                    </p>
                    <p class="text-sm font-medium truncate dark:text-[#ECEFF4] text-[#2E3440]" role="none">
                        Email
                    </p>
                </div>
                <ul class="py-1" role="none">
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm dark:text-[#ECEFF4] text-[#2E3440] dark:hover:text-[#81A1C1] hover:text-[#81A1C1]" role="menuitem">
                            <i class="fa-solid fa-gear"></i>
                            Paramètre
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 text-sm dark:text-[#ECEFF4] text-[#2E3440] dark:hover:text-[#81A1C1] hover:text-[#81A1C1]" role="menuitem">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="flex flex-grow">
        <aside class="flex flex-col w-72 dark:bg-[#2e3440] bg-[#D8DEE9] h-full overflow-auto sticky top-0" id="logo-sidebar">
            <div class="px-6 py-2 dark:bg-[#202227] bg-[#B7BFCF] shadow">
                <div class="dark:text-white text-[#202227] text-lg font-bold mt-1">Nom du Serveur</div>
                <h1 class="dark:text-white text-[#202227] flex items-center">
                    En ligne
                    <span class="ml-2 text-green-500 mb-1">
                        <i class="fa-sharp fa-solid fa-circle fa-beat fa-xs text-[#A3BE8C]"></i>
                    </span>
                </h1>
                <div class=" text-[#434C5E] mb-2 font-normal">Minecraft version : <span class="font-semibold">1.19.0</span></div>
            </div>
            <ul class="mt-6 overflow-y-auto">
                <li class="relative px-6 py-3">
                    <a href="#"
                        class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                        <i class="fa-solid fa-house"></i>
                        <span class="ml-4">Accueil</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a href="#"
                        class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                        <i class="fa-solid fa-server"></i>
                        <span class="ml-4">Mes Serveurs</span>
                    </a>
                </li>
                <li class="relative px-6 py-3">
                    <a href="#"
                        class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                        <i class="fa-solid fa-puzzle-piece"></i>
                        <span class="ml-4">Plugins</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    <button type="button"
                        class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]"
                        aria-controls="configSubMenu" data-collapse-toggle="configSubMenu">
                        <i class="fa-solid fa-cog"></i>
                        <span class="ml-4">Configuration</span>
                        <i class="fas fa-angle-right ml-2 rotate-90"></i>
                    </button>
                    <ul id="configSubMenu" class="hidden">
                        <li class="relative px-6 mt-2">
                            <a href="#"
                                class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fas fa-gears"></i>
                                <span class="ml-4">Général</span>
                            </a>
                        </li>
                        <li class="relative px-6 mt-2">
                            <a href="#"
                                class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fas fa-file-arrow-down"></i>
                                <span class="ml-4">Dépôt Fichiers</span>
                            </a>
                        </li>
                        <li class="relative px-6 mt-2">
                            <a href="#"
                                class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fas fa-shield-halved"></i>
                                <span class="ml-4">Paramètres Avancée</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="relative px-6 py-3">
                    <button type="button"
                        class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]"
                        data-collapse-toggle="SubMenu">
                        <i class="fa-solid fa-user"></i>
                        <span class="ml-4">Utilisateur</span>
                        <i class="fas fa-angle-right ml-2 rotate-90"></i>
                    </button>
                    <ul id="SubMenu" class="hidden">
                        <li class="relative px-6 mt-2">
                            <a href="#"
                                class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fa-sharp fa-solid fa-user-plus"></i>
                                <span class="ml-4">Sous-utilisateur</span>
                            </a>
                        </li>
                        <li class="relative px-6 mt-2">
                            <a href="#"
                                class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fa-solid fa-user-group"></i>
                                <span class="ml-4">Groupe</span>
                            </a>
                        </li>
                        <li class="relative px-6 mt-2">
                            <a href="#" class="inline-flex items-center w-full text-sm font-semibold dark:text-white text-[#434C5E] transition-colors duration-150 dark:hover:text-[#81A1C1] hover:text-[#81A1C1]">
                                <i class="fa-solid fa-gears"></i>
                                <span class="ml-4">Paramètres</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="absolute bottom-0 left-0 right-0 flex flex-col items-center px-6 py-3">
                <p class="text-sm dark:text-white text-[#434C5E] text-center">
                    MCServerManager<br> Version 1.0.0  © 2023
                </p>
                <div class="flex justify-center mt-1">
                    <a href="https://github.com/Foufou-exe" target="_blank">
                        <i class="fab fa-github dark:text-white text-[#434C5E] dark:hover:text-[#81A1C1] mr-2"></i>
                    </a>
                    <a href="https://github.com/thorbeorn" target="_blank">
                        <i class="fab fa-github dark:text-white text-[#434C5E] dark:hover:text-[#81A1C1]"></i>
                    </a>
                </div>
            </div>
        </aside>


        <!-- Section -->
        <section class="flex-grow dark:bg-[#3b4252] bg-[#ECEFF4] overflow-auto">
            <div class="flex flex-col justify-center items-center mx-10">
                <div id="elfinder">
                    <iframe src="public/src/elfinder/elfinder.src.html" width="100%" height="100%" frameborder="0"></iframe>
                </div>
            </div>
        </section>

    </div>
    <!-- Appel WEBAPPS et autres scripts -->
    <script src="https://kit.fontawesome.com/06dc38b1da.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.6/flowbite.min.js"></script>

    <!-- Script local -->
    <script type="module" src="public/assets/js/main.bundle.js"></script>

</body>

</html>