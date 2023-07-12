
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
