<?php 

    // Models/QueryMinecraft.php

    require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQuery.php';
    require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQueryException.php';

    use xPaw\MinecraftQuery;
    use xPaw\MinecraftQueryException;

    class QueryMinecraft
    {
        private $query;

        public function __construct()
        {
            $this->query = new MinecraftQuery();
        }

        public function getInfo()
        {
            try {
                $this->query->Connect('172.20.0.5', 25565);
                return $this->query->GetInfo();
            } catch (MinecraftQueryException $e) {
                echo $e->getMessage();
            }
        }

        public function getPlayers()
        {
            try {
                $this->query->Connect('172.20.0.5', 25565);
                return $this->query->GetPlayers();
            } catch (MinecraftQueryException $e) {
                echo $e->getMessage();
            }
        }
    }
