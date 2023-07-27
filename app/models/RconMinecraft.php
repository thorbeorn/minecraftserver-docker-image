<?php

    require_once Chemins::LIBS . 'vendor/autoload.php';


    use xPaw\SourceQuery\SourceQuery;

    class RconMinecraft {
        
        private $serverAddress;
        private $serverPort;
        private $rconPassword;
        private $query;

        public function __construct() {
            $this->serverAddress = '';
            $this->serverPort = '';
            $this->rconPassword = '';
            $this->query = new SourceQuery();
        }

        public function connect() {
            try {
                if ($this->query->GetAddress() != $this->serverAddress || 
                    $this->query->GetPort() != $this->serverPort) {
                        $this->query->Disconnect();
                }
                $this->query->Connect($this->serverAddress, $this->serverPort, 1, SourceQuery::SOURCE);
                $this->query->SetRconPassword($this->rconPassword);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function executeCommand($command) {
            try {
                return $this->query->Rcon($command);
            } catch (Exception $e) {
                echo $e->getMessage();
            } finally {
                $this->query->Disconnect();
            }
        }
    }
