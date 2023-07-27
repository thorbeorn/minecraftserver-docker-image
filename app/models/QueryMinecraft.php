<?php 

    // Models/QueryMinecraft.php

    require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQuery.php';
    require_once Chemins::LIBS_QUERY_MC .  'src/MinecraftQueryException.php';

    use xPaw\MinecraftQuery;
    use xPaw\MinecraftQueryException;

    class QueryMinecraft
    {
        private $query;
        private $ip;
        private $port;
    
        public function __construct()
        {
            $this->query = new MinecraftQuery();
            $this->ip = '172.20.0.5';
            $this->port = '25565';
    
            try {
                $this->query->Connect($this->ip, $this->port);
            } catch (MinecraftQueryException $e) {
                return $e->getMessage();
            }
        }
    
        public function getInfo()
        {
            try {
                return $this->query->GetInfo();
            } catch (MinecraftQueryException $e) {
                return $e->getMessage();
            }
        }
    
        public function getPlayers()
        {
            try {
                return $this->query->GetPlayers();
            } catch (MinecraftQueryException $e) {
                return $e->getMessage();
            }
        }
    }
    