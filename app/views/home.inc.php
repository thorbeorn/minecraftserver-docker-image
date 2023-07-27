<?php
    require_once 'configs/routes.class.php';
    require_once Chemins::CONTROLEURS . 'QueryMinecraftController.php';
    require_once Chemins::CONTROLEURS . 'InfoServerController.php';

    // Donnes du serveur via Query
    $data = new QueryMinecraftController();
    $info = $data->displayInfo();

    // Donnes du serveur via Docker
    $docker = new InfoServerMinecraftController();
    $CPU = $docker->getCpuUsage();
    $RAM = $docker->getRamUsage();
    $RAMLimit = $docker->getRamLimit();
    $ID = $docker->getContainerId();
    $Name = $docker->getContainerName();
    $Status = $docker->getStatus();
    $Ip = $docker->getIp();
    $PortQuery = $docker->getPortQuery();
    $PortRcon = $docker->getPortRcon();
    $DiskLimit = $docker->getDiskLimit();
    $DiskUsed = $docker->getDiskUsed();

?>

<!-- Section -->
<section class="flex-grow dark:bg-[#3b4252] bg-[#ECEFF4] overflow-auto">
    <div class="flex flex-col justify-center items-center mx-10">
        <!-- First Container -->
        <div class="container my-10">
            <h1 class="font-bold text-3xl dark:text-[#ECEFF4] text-[#434C5E] mb-4" style="font-family: 'Century Gothic', sans-serif;"><?= $Name ?></h1>
            <div class="container mt-5 mb-5 md:grid md:grid-cols-3 md:gap-2">

                <!-- Console Block and Network Block -->
                <div class="md:grid md:grid-cols-1 md:col-span-2 flex flex-col">
                    <div class="dark:bg-[#2e3440] bg-[#E5E9F0] px-4 py-3 rounded md:grid md:grid-cols-2 gap-4 mb-4">
                        <div class="md:flex items-center justify-start ml-5 mt-2">
                            <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                Status du serveur
                            </h3>
                            <? if (trim(strtolower($Status)) === 'running') : ?>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold ml-10 mb-1">
                                    En ligne
                                </span>
                                <i class="fa-solid fa-circle-check text-[#A3BE8C] ml-2 font-medium"></i>
                            <? elseif (trim(strtolower($Status)) === 'exited') : ?>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold ml-10 mb-1">
                                    Hors ligne
                                </span>
                                <i class="fa-solid fa-circle-check ml-2 font-medium" style="color: #bf616a;"></i>
                            
                            <? elseif (trim(strtolower($Status)) === 'paused') : ?>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold ml-10 mb-1">
                                    En attente
                                </span>
                                <i class="fa-solid fa-circle-check ml-2 font-medium" style="color: #EBCB8B;"></i>
                            <? else : ?>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold ml-10 mb-1">
                                    Inconnu
                                </span>
                                <i class="fa-solid fa-circle-check ml-2 font-medium" style="color: #D8DEE9;"></i>
                            <? endif; ?>
                        </div>
                        <div class="md:flex items-center justify-start mt-2">
                            <h3 class="text-lg mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                Nombre de joueurs
                            </h3>
                            <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-10 mt-1 mb-2 mr-3">
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="user-usage">
                                    <?= $info['Players'] ?: '-'; ?>
                                </span> 
                                / <?= $info['MaxPlayers'] ?: '-'; ?>
                            </p>
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
                    
                    <div class="dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 mb-4 rounded flex flex-col flex-shrink">
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
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-5 pr-10 rounded">
                        <div class="ml-4 mr-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-server text-xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-base font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    IP
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                <?= $Ip ?>
                            </div>
                    
                            <div class="flex items-center ml-4 mb-2 md:mb-0">
                                <i class="fas fa-globe text-xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-base font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    ID
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                <?= $ID ?>
                            </div>
                    
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-network-wired text-xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-base font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    Port
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                <?= $PortQuery ?>
                            </div>
                    
                            <div class="flex items-center ml-4 mb-2 md:mb-0 mr-10">
                                <i class="fas fa-key text-xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-base font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    RCON
                                </h3>
                            </div>
                            <div class="dark:text-[#ECEFF4] text-[#434C5E] font-bold">
                                <?= $PortRcon ?>
                            </div>
                        </div>
                    </div>

                    <!-- Disque Dur -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 pl-4 pt-3 pb-1 rounded">
                        <div class="ml-4 mb-3 grid grid-cols-1 md:grid-cols-2">
                            <div class="flex items-center mb-2 md:mb-0">
                                <i class="fas fa-hdd text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                <h3 class="text-base font-semibold dark:text-[#4C566A] text-[#3B4252]">
                                    Espaces disque
                                </h3>
                            </div>
                            <div>
                                <span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="disk-space"><?= $DiskUsed ?> Go <a class="font-semibold dark:text-[#4C566A] text-[#3B4252]">/ <?= $DiskLimit ?> Go</a></span>
                            </div>
                        </div>
                    </div>



                    <!-- CPU -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 rounded">
                        <div class="ml-4 flex items-center">
                            <div class="grid grid-cols-1 sm:grid-cols-2">
                                <h3 class="text-base mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                    <i class="fas fa-microchip text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                    CPU
                                </h3>
                                <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-0 sm:ml-10 mb-2"><span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="cpu-usage"><?= $CPU ?> %</span> / 100%</p>
                            </div>
                        </div>
                        <canvas id="cpu-performance-chart"></canvas>
                    </div>

                    <!-- RAM -->
                    <div class="relative dark:bg-[#2e3440] bg-[#E5E9F0] mt-2 p-4 rounded">
                        <div class="ml-4 flex items-center">
                            <div class="grid grid-cols-1 sm:grid-cols-2">
                                <h3 class="text-base mb-2 font-semibold dark:text-[#4C566A] text-[#3B4252] flex items-center">
                                    <i class="fas fa-memory text-2xl dark:text-[#4C566A] text-[#3B4252] mr-1"></i>
                                    RAM
                                </h3>
                                <p class="dark:text-[#4C566A] text-[#3B4252] font-semibold ml-0 sm:ml-10 mb-2"><span class="dark:text-[#ECEFF4] text-[#434C5E] font-bold" id="ram-usage"><?= $RAM ?></span> / <?= $RAMLimit ?>GiB</p>
                            </div>
                        </div>
                        <canvas id="ram-performance-chart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>