<?php
    require_once 'configs/routes.class.php';

    // $gestionServer = new GestionServer();
    $dir = "/";

    // Ouvre un répertoire bien connu, et lit ses fichiers
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                echo "fichier : $file : type : " . filetype($dir . $file) . "\n";
            }
            closedir($dh);
        }
    }
    
?>


