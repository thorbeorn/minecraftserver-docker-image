<?php 

    namespace GestionsServer;

    class GestionServer {
        // Fonction pour récuperer le pourcentage d'utilisation du CPU
        public function getDockerStatsCpu($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . ' --no-stream --format "{{ .CPUPerc }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = str_replace("%", "",$data);
                return $resulat;
            }
        }

        // Fonction pour récuperer le pourcentage d'utilisation de la RAM
        public function getDockerStatsRamPourcentage($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . '  --no-stream --format "{{ .MemPerc }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = str_replace("%", "",$data);
                return $resulat;
            }
        }

        // Fonction pour récuperer la RAM utilisée
        public function getDockerStatsRam($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . ' --no-stream --format "{{ .MemUsage }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = explode(" / ", $data);
                return str_replace("MiB", "",$resulat[0]);
            }
        }

        // Fonction pour récuperer la RAM limite
        public function getDockerStatsRamLimit($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . ' --no-stream --format "{{ .MemUsage }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = explode(" / ", $data);
                return str_replace("GiB", "",$resulat[1]);
            }
        }

        // Fonction pour récuperer l'ID du container
        public function getDockerStatsId($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . '  --no-stream --format "{{ .ID }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Fonction pour récuperer le nom du container
        public function getDockerStatsNameServer($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . '  --no-stream --format "{{ .Name }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Fonction pour récuperer le réseau entrant du container
        public function getDockerStatsNetworkEnter($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . '  --no-stream --format "{{ .NetIO }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = explode(" / ", $data);
                return str_replace("kB", "",$resulat[0]);
            }
        }

        // Fonction pour récuperer le réseau sortie du container
        public function getDockerStatsNetworkOut($nameContainer) {
            $data = shell_exec('sudo docker stats ' . $nameContainer . '  --no-stream --format "{{ .NetIO }}" 2>&1');
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $resulat = explode(" / ", $data);
                return str_replace("kB", " ",$resulat[1]);
            }
        }

        // Fonction pour récuperer le disque total du container
        public function getDockerStatsDiskLimit() {
            $data = shell_exec("sudo df -h / | grep '/' | awk '{print $2}' | sed 's/G//'");
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Fonction pour récuperer le disque utilisé du container
        public function getDockerStatsDiskUsed() {
            $data = shell_exec("sudo df -h / | grep '/' | awk '{print $3}' | sed 's/G//'");
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Focntion qui recupere le status du container
        public function getDockerStatus($nameContainer) {
            $data = shell_exec("sudo docker container inspect -f '{{.State.Status}}' ' . $nameContainer . '");
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Focntion qui recupere le port Query du container
        public function getDockerPortQuery($nameContainer) {
            $data = shell_exec("sudo docker port ' . $nameContainer . ' | grep 25565 | awk '{print $3}' | sed 's/0.0.0.0://'");
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }

        // Fonction qui recupere le port Rcon du container  
        public function getDockerPortRcon($nameContainer) {
            $data = shell_exec("sudo docker port ' . $nameContainer . ' | grep 25575 | awk '{print $3}' | sed 's/0.0.0.0://'");
            if ($data === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                return $data;
            }
        }
    }


?>

