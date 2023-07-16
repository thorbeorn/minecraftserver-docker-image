<?php 
   $container_id = 'test';
   ob_start();
   $handle = popen("sudo docker logs -f $container_id 2>&1", 'r');
   
   while(($buffer = fgets($handle)) !== false) {
       echo str_pad($buffer . "<br>", 4096); 
   
       if (ob_get_length()) {
           @ob_flush();
           @flush();
           ob_end_flush();
       }
      ob_start();
   }
   
   pclose($handle);