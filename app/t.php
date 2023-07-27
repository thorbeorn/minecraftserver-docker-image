<?php 
    require_once 'configs/routes.class.php';
    require_once Chemins::CONTROLEURS . 'QueryMinecraftController.php';

    $data = new QueryMinecraftController();
    $info = $data->displayInfo();

    echo $info['HostName'] . '<br>';
    echo $info['GameType']. '<br>';
    echo $info['Map']. '<br>';
    echo $info['Players']. '<br>';
    echo $info['MaxPlayers']. '<br>';
    echo $info['HostPort']. '<br>';
    echo $info['HostIp']. '<br>';
    echo $info['Version']. '<br>';
    echo $info  ['Plugins']. '<br>';
    