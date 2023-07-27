<?php 
    class InfoServerMinecraft {
        private $nameContainer;
        
        public function __construct() {
            $this->nameContainer = 'test';
        }

        public function getDockerStats() {
            $json = shell_exec('sudo docker stats --no-stream --format "{{ json . }}" ' . $this->nameContainer . ' 2>&1');
            if ($json === null) {
                return "-";
                return null;
            } else {
                return json_decode($json, true); // Convert the JSON string into an associative array
            }
        }

        // Fonction pour récuperer le disque total du container
        public function getDockerDiskLimit() {
            $data = shell_exec("sudo df -h / | grep '/' | awk '{print $2}' | sed 's/G//'");
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }

        // Fonction pour récuperer le disque utilisé du container
        public function getDockerDiskUsed() {
            $data = shell_exec("sudo df -h / | grep '/' | awk '{print $3}' | sed 's/G//'");
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }

        // Focntion qui recupere le status du container
        public function getDockerStatsStatus() {
            $data = shell_exec('sudo docker container inspect -f "{{.State.Status}}" ' . $this->nameContainer . '');
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }

        // Focntion qui recupere le port Query du container
        public function getDockerStatsPortQuery() {
            $data = shell_exec("sudo docker port " . $this->nameContainer . " | grep 25565 | awk '{print $3}' | sed 's/0.0.0.0://'");
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }

        // Fonction qui recupere le port Rcon du container  
        public function getDockerStatsPortRcon() {
            $data = shell_exec("sudo docker port " . $this->nameContainer . " | grep 25575 | awk '{print $3}' | sed 's/0.0.0.0://'");
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }

        // Fonction qui recupere l'adresse IP du container
        public function getDockerStatsIp() {
            $data = shell_exec('sudo docker inspect -f "{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}" ' . $this->nameContainer . '');
            if ($data === null) {
                return "-";
            } else {
                return $data;
            }
        }







    }