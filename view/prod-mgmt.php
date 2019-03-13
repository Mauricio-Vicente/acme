<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}

if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/style.css" rel="stylesheet" >
        <title>Acme</title>
    </head>
    <body>
        <header>
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>

        <main>
            <h1>Product Management</h1>
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

        <!-- Footer -->
        <?php require '../common/footer.php' ?>
        <!--Footer-->

    </body>
</html>
<?php unset($_SESSION['message']); ?>
