<?php

    require_once Chemins::MODELS . 'ConsoleServerMinecraft.php';

    class ConsoleServerMinecraftController {

        private $logModel;

        public function __construct($container_id) {
            $this->logModel = new ConsoleServerMinecraft($container_id);
        }

        public function displayDockerLogs() {
            $logs = $this->logModel->getDockerLogs();

            if ($logs === null) {
                echo "Erreur : Impossible d'afficher les logs.";
            } else {
                foreach ($logs as $log) {
                    echo $log . "<br>";
                }
            }
        }

        public function changeContainer($new_container_id) {
            $this->logModel->changeContainer($new_container_id);
        }
    }
