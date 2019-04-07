<?php
if (!$_SESSION['loggedin']) {
    header('Location: /acme/');
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <title>ACM - Image Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
        <title>Acme</title>
    </head>
    <body>
        <header class="top-layer">
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>
        <main class="top-layer">
            <h2 id="delconf">Add New Product Image</h2>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Product</label><br>
                <?php echo $prodSelect; ?><br>
                <input type="file" name="file1" class="inputfile" id="file">
                <label for="file"><span>  Choose a file</span></label><br>
                <input type="submit" value="Upload" class="submitBtn">
                <input type="hidden" name="action" value="upload">
            </form>

            <h2 class="add-image">Existing Images</h2>
            <p class="reg-message">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            }
            ?>
        </main>

        <footer class="top-layer">
            <hr>
            <?php require '../common/footer.php' ?>  
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>


    </body>
</html>
<?php unset($_SESSION['message']); ?>


