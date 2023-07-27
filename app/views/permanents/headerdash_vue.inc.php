<?php
    
    require_once Chemins::CONTROLEURS . 'UserController.php';

    $pdoInstance = new ModelsPDO();
    $userController = new UserController($pdoInstance);

    if (isset($_SESSION['user'])) {
        $pseudo = $_SESSION['user'];
        $userData = $userController->getUserData($pseudo);
    } else {
        header('Location: index.php');
        exit();
    }
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
                    <img class="w-10 h-10 rounded-full" src="<?= $userData['image'] ?>" alt="user photo">
                </button>
            </div>

            <div class="z-50 hidden my-4 text-base list-none  divide-y rounded shadow dark:bg-[#202227] bg-[#D8DEE9] divide-gray-700"
                id="dropdown-user">
                <div class="px-4 py-3" role="none">
                    <p class="text-sm dark:text-[#D8DEE9] text-[#434C5E]" role="none">
                        <?= $userData['pseudo'] ?>
                    </p>
                    <p class="text-sm font-medium truncate dark:text-[#ECEFF4] text-[#2E3440]" role="none">
                        <?= $userData['email'] ?>
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