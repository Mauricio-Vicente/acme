
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title><?php
            if (isset($prodInfo['invName'])) {
                echo "Modify $prodInfo[invName] ";
            } elseif (isset($invName)) {
                echo $invName;
            }
            ?> | Acme, Inc</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
    </head>
    <body>
     
        <header class="top-layer">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> 
            
            <nav>
                <?php echo $navList; ?>     
            </nav>
        </header>

        <main class="top-layer">  
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <?php
            if (isset($prodDisplay)) {
                echo $prodDisplay;
            }
            ?>
        </main>

        <footer class="top-layer">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
        </footer>

        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>

    </body>
</html>

