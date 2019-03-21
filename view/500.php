<?php
$directoryName = 'error';
$pageTitle = 'Oopsies. Something Wronnky happened!.';
$pageDescription = "Something wonky happened, sorry about that.";
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="/acme/css/normalize.css" rel="stylesheet"  type="text/css" media="screen">
        <link href="/acme/css/style.css" rel="stylesheet"  type="text/css" media="screen">
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
            <h1>Server Error </h1>
            <h3>Sorry, the server experienced a problem</h3>
        </main>
        <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
    </body>
</html>
