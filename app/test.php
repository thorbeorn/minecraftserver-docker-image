<?php

use GestionsServer\GestionServer;

    require_once 'configs/routes.class.php';
    require_once Chemins::CONTROLEURS . 'GestionServer.php';

    $gestionServer = new GestionServer();
    echo 'Cpu utilisation : ' . $gestionServer->getDockerStatsCpu() . '% <br>';
    echo 'Ram utilisation : ' . $gestionServer->getDockerStatsRamPourcentage() . '  /  ' . $gestionServer->getDockerStatsRam() . ' MiB ' . $gestionServer->getDockerStatsRamLimit() . 'GiB <br>';
    echo 'Id du container : ' . $gestionServer->getDockerStatsId() . '<br>';
    echo 'Name du container : ' . $gestionServer->getDockerStatsNameServer() . '<br>';
    echo 'Network Entrer du container : ' . $gestionServer->getDockerStatsNetworkEnter() . '<br>';
    echo 'Network Sortie du container : ' . $gestionServer->getDockerStatsNetworkOut() . '<br>';
    echo 'Disk utilisé du container : ' . $gestionServer->getDockerStatsDiskUsed() . '<br>';
    echo 'Disk limite du container : ' . $gestionServer->getDockerStatsDiskLimit() . '<br>';
    echo 'Status du container : ' . $gestionServer->getDockerStatus() . '<br>';
    echo 'Port Query du container : ' . $gestionServer->getDockerPortQuery() . '<br>';
    echo 'Port Rcon du container : ' . $gestionServer->getDockerPortRcon() . '<br>';
?>


