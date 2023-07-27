<?php 
    require_once Chemins::MODELS . 'QueryMinecraft.php';

    class QueryMinecraftController
    {
        private $model;

        public function __construct()
        {
            $this->model = new QueryMinecraft();
        }

        public function displayInfo()
        {
            $info = $this->model->getInfo();
            return $info;

        }

        public function displayPlayers()
        {
            $players = $this->model->getPlayers();
            foreach ($players as $player) {
                echo $player . '<br>';
            }
        }
    }