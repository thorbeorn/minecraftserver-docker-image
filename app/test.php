<?php
   $json = shell_exec('sudo docker stats mcservermanager-php-1 --no-stream --format "{{ json . }}" 2>&1');

   if ($json === null) {
       return "Erreur : Aucune donnée retournée par la commande shell.";
   } else {
       $data = json_decode($json);

       if ($data === null) {
           return "Erreur : Le JSON n'a pas pu être décodé.";
       } else {
           $result = "";

           $blockIO = explode(" / ", $data->BlockIO);
           $result .= "BlockIO: " . rtrim($blockIO[0], "MB") . "  " . rtrim($blockIO[1],"MB") . "<br>";

           $result .= "CPUPerc: " . rtrim($data->CPUPerc, "%") . "<br>";
           $result .= "Container: " . $data->Container . "<br>";
           $result .= "ID: " . $data->ID . "<br>";

           $memPerc = rtrim($data->MemPerc, "%");
           $result .= "MemPerc: " . $memPerc . "<br>";

           $memUsage = explode(" / ", $data->MemUsage);
           $result .= "MemUsage: " . rtrim($memUsage[0],"MiB") . "  " . rtrim($memUsage[1],"GiB") . "<br>";

           $result .= "Name: " . $data->Name . "<br>";

           $netIO = explode(" / ", $data->NetIO);
           $result .= "NetIO: " . rtrim($netIO[0],"MB") . "  " . rtrim($netIO[1],"MB") . "<br>";

           $result .= "PIDs: " . $data->PIDs . "<br>";

           echo $result;
       }
   }

?>
