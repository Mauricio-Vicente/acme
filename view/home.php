<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title>ACM - Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/normalize.css" rel="stylesheet"  type="text/css" media="screen">    
        <link href="/acme/css/style.css" rel="stylesheet"  type="text/css" media="screen">  
        
    </head>
    <body>
        <header>

            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/header.php"; ?>


            <nav>
                <?php echo $navList; ?>     
            </nav>
        </header>
        <main>

            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/main.php"; ?>     
        </main>
        <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        
    </div>
</body>
</html>