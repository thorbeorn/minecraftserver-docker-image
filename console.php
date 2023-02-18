<?php
$workdir = str_replace("../", "", $_GET["server"]);
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="console.css">
        <script src="includes/jquery-3.6.3.min.js"></script>
        <title>MCManager | console</title>
    </head>
    <body>
        <div class="console_box">
            <div class="console_log">
                <?php
                $handle = fopen($workdir . "/logs/latest.log", "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {
                        $formatedLine = str_replace("[m", "", $line) . "<br/>";
                        if(strpos($formatedLine, "Rcon connection from:") == false){
                            echo "<p>" . $formatedLine . "</p>";
                        }
                    }
                    fclose($handle);
                }
                ?>
            </div>
            <div class="console_cmd">
                <div class="console_cmd_label">
                    <p>></p>
                </div>
                <div class="console_cmd_cmd">
                <input type="text" id="console_cmd_cmd_input" name="console_cmd_cmd_input" onkeydown="search(this, '<?php echo $workdir; ?>')" required>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            let console_cmd_cmd_input = document.getElementById("console_cmd_cmd_input");
            setInterval(function() {
                console_cmd_cmd_input.focus();
            }, 100);

            function search(element, path) {
                if(event.key === 'Enter') {
                    $.ajax( {
						type: "POST",
						url: 'modules/send_rcon.php',
						data: {Path: path, CMD: element.value},
						success: function(response) {
							console.log(response);
						}					
					} );     
                }
            }
        </script>
    </body>
</html>