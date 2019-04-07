<?php
//if ($_SESSION['clientData']['clientLevel'] < 2) {
// header('location: /acme/');
// exit;
//}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title>Acme</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
    </head>
    <body>
        <header class="top-layer">
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>  
            </nav>

        </header>

        <main class="top-layer">
            <h2>Product Management</h2>
            <p>Welcome to the product management page. Please choose an option below:</p>
            <ul>
                <li><a href = "/acme/products/index.php?action=new-cat" title = "add category">Add a New Category</a></li>
                <li><a href = "/acme/products/index.php?action=new-prod" title = "add product">Add a New Product</a></li>
            </ul>
            <?php
            if (isset($message)) {
                echo $message;
            } if (isset($prodList)) {
                echo $prodList;
            }
            ?>
        </main>
        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>

    </body>
</html>
<?php unset($_SESSION['message']); ?>
