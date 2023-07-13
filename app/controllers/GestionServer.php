<?php 

    namespace GestionsServer;

    class GestionServer {

        public function getDockerStatsCpu() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1  --no-stream --format "{{ .CPUPerc }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    echo rtrim($data->CPUPerc, "%");
                }
            }
        }

        public function getDockerStatsRamPourcentage() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    echo rtrim($data->MemPerc, "%");
                }
            }
        }
        public function getDockerStatsRam() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    $memUsage = explode(" / ", $data->MemUsage);
                    echo rtrim($memUsage[0],"MiB");
                }
            }
        }


        public function getDockerStatsRamLimit() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    $memUsage = explode(" / ", $data->MemUsage);
                    echo rtrim($memUsage[1],"GiB");
                }
            }
        }

        public function getDockerStatsId() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    echo $data->ID;
                }
            }
        }

        public function getDockerStatsNameServer() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    echo $data->Name;
                }
            }
        }

        public function getDockerStatsNetworkEnter() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    $netIO = explode(" / ", $data->NetIO);
                    echo rtrim($netIO[0],"MB");
                }
            }
        }

        public function getDockerStatsNetworkOut() {
            $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                $data = json_decode($json);
                if ($data === null) {
                    echo "Erreur : Le JSON n'a pas pu être décodé.";
                } else {
                    $netIO = explode(" / ", $data->NetIO);
                    echo rtrim($netIO[1],"MB");
                }
            }
        }

        public function getDockerStatsDiskLimit() {
            $json = shell_exec("sudo df -h / | grep '/' | awk '{print $2}' | sed 's/G//'");
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                echo $json;
            }
        }

        public function getDockerStatsDiskUsed() {
            $json = shell_exec("sudo df -h / | grep '/' | awk '{print $3}' | sed 's/G//'");
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
            } else {
                echo $json;
            }
        }

    }


?>

