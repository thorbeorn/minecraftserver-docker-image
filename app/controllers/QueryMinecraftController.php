<?php 

    require_once 'configs/routes.class.php';
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
            $players = $this->model->getPlayers();

            return $info;
            return $players;
        }
    }