<?php
$directoryName = 'error';
$pageTitle = 'Oopsies. Something Wrong happened!.';
$pageDescription = "Something wrong happened, sorry about that.";
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <title>Acme</title>
        <meta name = "viewport" content="width=device-width, initial-scale=1">
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
            <h1>Server Error </h1>
            <h3>Sorry, the server experienced a problem</h3>
        </main>
        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>

    </body>
</html>
