<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/style.css" rel="stylesheet"  type="text/css" media="screen">  
        <title><?php echo $category; ?> Products | Acme, Inc.</title>
    </head>
    <body>
        <header>
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>
        <main>
            <h1><?php echo $category; ?> Products</h1>
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
       <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

    </body>
</html>

