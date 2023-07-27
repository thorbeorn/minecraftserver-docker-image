<?php

class ConsoleServerMinecraft {

    private $container_id;
    private $handle;

    public function __construct($container_id) {
        $this->container_id = $container_id;
        $this->handle = popen("sudo docker logs -f $this->container_id 2>&1", 'r');
    }

    public function getDockerLogs() {
        $logs = [];
   
        while(($buffer = fgets($this->handle, 1024)) !== false) {
            $logs[] = $buffer;
        }

        return $logs;
    }

    public function changeContainer($new_container_id) {
        // Terminate the log command for the old container
        pclose($this->handle);

        // Start the log command for the new container
        $this->container_id = $new_container_id;
        $this->handle = popen("sudo docker logs -f $this->container_id 2>&1", 'r');
    }
}