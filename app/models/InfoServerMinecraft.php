<?php 
    class InfoServerMinecraft {

        public function getDockerStats($nameContainer) {
            $json = shell_exec('sudo docker stats --no-stream --format "{{ json . }}" ' . $nameContainer . ' 2>&1');
            if ($json === null) {
                echo "Erreur : Aucune donnée retournée par la commande shell.";
                return null;
            } else {
                return json_decode($json, true); // Convert the JSON string into an associative array
            }
        }
    }