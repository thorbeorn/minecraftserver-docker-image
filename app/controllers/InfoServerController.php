<?php 

    require_once Chemins::MODELS . 'InfoServerMinecraft.php';

    class InfoServerMinecraftController {
    
        private $model;
        private $dockerStats;
        private $dockerDiskLimit;
        private $dockerDiskUsed;
        private $dockerPortQuery;
        private $dockerPortRcon;
        private $dockerIp;
        private $dockerStatus;
    
        public function __construct() {
            $this->model = new InfoServerMinecraft();
            $this->dockerStats = $this->model->getDockerStats();
            $this->dockerDiskLimit = $this->model->getDockerDiskLimit();
            $this->dockerDiskUsed = $this->model->getDockerDiskUsed();
            $this->dockerPortQuery = $this->model->getDockerStatsPortQuery();
            $this->dockerPortRcon = $this->model->getDockerStatsPortRcon();
            $this->dockerIp = $this->model->getDockerStatsIp();
            $this->dockerStatus = $this->model->getDockerStatsStatus();

        }
    
        public function getCpuUsage() {
            $cpuUsage = $this->dockerStats['CPUPerc'];
            $result = str_replace("%", "",$cpuUsage);
            return $result;
        }
    
        public function getRamUsagePercentage() {
            $memPerc = $this->dockerStats['MemPerc'];
            $result = str_replace("%", "",$memPerc);
            return $result;
        }
    
        public function getRamUsage() {
            $memUsage = $this->dockerStats['MemUsage'];
            $result = explode(" / ", $memUsage);
            return str_replace("MiB", "",$result[0]);
        }
    
        public function getRamLimit() {
            $memUsage = $this->dockerStats['MemUsage'];
            $result = explode(" / ", $memUsage);
            return str_replace("GiB", "",$result[1]);
        }
    
        public function getContainerId() {
            return $this->dockerStats['ID'];
        }
    
        public function getContainerName() {
            return $this->dockerStats['Name'];
        }
    
        public function getNetworkInput() {
            $netIO = $this->dockerStats['NetIO'];
            $result = explode(" / ", $netIO);
            return str_replace("kB", "",$result[0]);
        }
    
        public function getNetworkOutput() {
            $netIO = $this->dockerStats['NetIO'];
            $result = explode(" / ", $netIO);
            return str_replace("kB", "",$result[1]);
        }

        // Fonction pour récuperer le disque total du container
        public function getDiskLimit() {
            return $this->dockerDiskLimit;
        }

        // Fonction pour récuperer le disque utilisé du container
        public function getDiskUsed() {
            return $this->dockerDiskUsed;
        }

        // Focntion qui recupere le status du container
        public function getStatus() {
            return $this->dockerStatus;
        }

        // Focntion qui recupere le port Query du container
        public function getPortQuery() {
            return $this->dockerPortQuery;
        }

        // Fonction qui recupere le port Rcon du container  
        public function getPortRcon() {
            return $this->dockerPortRcon;
        }

        // Fonction qui recupere l'adresse IP du container
        public function getIp() {
            return $this->dockerIp;
        }

    }
?>

