<?php
    // On récupere les informations de l'utilisateur dans la base de données
    $user = $auth->user();
    $server = $user->server()->first();

?>



<!-- Section -->
<section class="flex-grow dark:bg-[#3b4252] bg-[#ECEFF4] overflow-auto">
    <div class="flex flex-col justify-center items-center mx-10">
        <!-- First Container -->
        <div class="container my-10">
            <h1 class="font-bold text-3xl dark:text-[#ECEFF4] text-[#434C5E] mb-4" style="font-family: 'Century Gothic', sans-serif;">Nom du Serveur</h1>
            <div class="container mt-5 mb-5 md:grid md:grid-cols-3 md:gap-2">

                <!-- Console Block and Network Block -->
                <div class="md:grid md:grid-cols-1 md:col-span-2 flex flex-col">
                    <div class="dark:bg-[#2e3440] bg-[#E5E9F0] px-4 py-3 rounded md:grid md:grid-cols-2 gap-4 mb-4">
                        <div class="md:flex items-center justify-start ml-5 mt-2">
                            <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                Status du serveur
                            </h3>
                            <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold ml-10 mb-1">En ligne</span>
                            <i class="fa-solid fa-circle-check text-[#A3BE8C] ml-2 font-medium"></i>
                        </div>
                        <div class="md:flex items-center justify-start mt-2">
                            <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                Nombre de joueurs
                            </h3>
                            <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-10 mt-1 mb-2 mr-3"><span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="user-usage">50</span> / 100</p>
                            <i class="fas fa-users text-lg dark:text-[#4C566A] text-[#434C5E] mb-1"></i>
                        </div>
                    </div>
                    
                    <div class="dark:bg-[#2e3440] bg-[#E5E9F0] p-4 rounded flex flex-col mb-4 md:mb-0 flex-grow">
                        <div class="text-[#3B4252] dark:text-[#ECEFF4] p-4 rounded h-auto md:h-[600px] overflow-auto">
                            <pre id="console-output">
                                <!-- La sortie de la console sera ici -->
                            </pre>
                        </div>
                        <hr class="border-[#4C566A] mt-4 mb-2">
                        <div class="relative flex flex-wrap items-center">
                            <i class="fas fa-angle-right dark:text-[#4C566A] text-[#4C566A] absolute mt-2 ml-2 text-xl"></i>
                            <input type="text" class="flex-grow leading-tight focus:outline-none pl-8 mb-1 rounded appearance-none bg-transparent border-none dark:text-[#E5E9F0] text-[#4C566A] text-lg focus:font-semibold w-full sm:w-auto" placeholder="Tapez une commande ici...">
                            <div class="mt-1 sm:ml-2">
                                <button class="dark:text-[#4C566A] text-[#4C566A] font-bold py-2 px-4 sm:px-8 rounded" data-tippy-content="Envoyer">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            <div class="mt-1 sm:ml-2">
                                <button class="dark:text-[#4C566A] text-[#4C566A] font-bold py-2 px-4 sm:px-8 rounded" data-tippy-content="Nettoyer">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 rounded flex flex-col flex-shrink">
                        <div class="ml-4 flex items-center">
                            <div class="mt-4">
                                <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#434C5E] flex items-center">
                                    <i class="fab fa-cloudscale text-2xl dark:text-[#4C566A] text-[#434C5E] mr-1"></i>
                                    Network Usage
                                </h3>
                            </div>
                        </div>
                        <div>
                            <canvas id="network-chart"></canvas>
                        </div>
                    </div>
                </div>

                    

                <!-- Second Column (Rest of the information) -->
                <div class="flex flex-col w-full md:col-span-1 ml-3">
                    <!-- Action Serveur -->
                    <div class="flex flex-col sm:flex-row items-center justify-center mb-2">
                        <div class="flex flex-wrap items-center space-x-2 sm:space-x-2">
                            <button class="px-6 py-2 sm:px-8 sm:py-2 font-bold text-white bg-[#BF616A] rounded hover:bg-red-700" data-tippy-content="Arrêter">
                                <i class="fas fa-stop"></i>
                            </button>
                            <button class="px-6 py-2 sm:px-8 sm:py-2 font-bold text-white bg-[#A3BE8C] rounded hover:bg-green-700" data-tippy-content="Démarrer">
                                <i class="fas fa-play"></i>
                            </button>
                            <button class="px-6 py-2 sm:px-8 sm:py-2 font-bold text-white bg-[#5E81AC] rounded hover:bg-blue-700" data-tippy-content="Redémarrer">
                                <i class="fas fa-redo"></i>
                            </button>
                            <button class="px-6 py-2 sm:px-8 sm:py-2 font-bold text-white bg-[#D08770] rounded hover:bg-orange-700" data-tippy-content="Réinitialiser">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Informations -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-5 rounded">
                        <div class="ml-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-server text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-lg font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    IP
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                192.168.1.1
                            </div>
                    
                            <div class="flex items-center ml-2 mb-2 md:mb-0">
                                <i class="fas fa-globe text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-lg font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    ID
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                123456
                            </div>
                    
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-network-wired text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-lg font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    Port
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                8000
                            </div>
                    
                            <div class="flex items-center ml-2 mb-2 md:mb-0">
                                <i class="fas fa-key text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-lg font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    RCON
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                25565
                            </div>
                        </div>
                    </div>

                    <!-- Disque Dur -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 pl-4 pt-3 pb-1 rounded">
                        <div class="ml-4 mb-3 grid grid-cols-1 md:grid-cols-2">
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-hdd text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-lg font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    Espaces disque
                                </h3>
                            </div>
                            <div>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="disk-space">500 GB <a class="font-semibold dark:text-[#4C566A] text-[#3B4252]">/ 1To</a></span>
                            </div>
                        </div>
                    </div>



                    <!-- CPU -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 rounded">
                        <div class="ml-4 flex items-center">
                            <div class="grid grid-cols-1 sm:grid-cols-2">
                                <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                    <i class="fas fa-microchip text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                    CPU
                                </h3>
                                <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-0 sm:ml-10 mb-2"><span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="cpu-usage">50%</span> / 100%</p>
                            </div>
                        </div>
                        <canvas id="cpu-performance-chart"></canvas>
                    </div>

                    <!-- RAM -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 rounded">
                        <div class="ml-4 flex items-center">
                            <div class="grid grid-cols-1 sm:grid-cols-2">
                                <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                    <i class="fas fa-memory text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                    RAM
                                </h3>
                                <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-0 sm:ml-10 mb-2"><span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="ram-usage">50</span> / X Mio</p>
                            </div>
                        </div>
                        <canvas id="ram-performance-chart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>