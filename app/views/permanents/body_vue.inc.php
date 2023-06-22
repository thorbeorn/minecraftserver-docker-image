<?php require_once 'header.inc.php'; ?>
<body class="gradient-background flex flex-col items-center justify-center h-screen">
    <div class="shadow-2xl rounded-lg overflow-hidden bg-white shadow-[#34495E]/100">
        <?php
            $page_content = isset($page_content) ? $page_content : 'connexion.php';
            include($page_content);
        ?>
    </div>
</body>
</html>
