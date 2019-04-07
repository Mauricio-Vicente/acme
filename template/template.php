<!DOCTYPE html>
<html lang="en-US">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Template | ACME Inc. </title>
        <meta name="description" content="Template page">
         <meta name = "viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
    </head>

    <body>

    
        <header class="top-layer">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?> 
        </header>

        <nav>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/nav.php'; ?> 
        </nav>
        
            <main class="top-layer">  
                <h1>Content Title</h1>
            </main>

            <footer class="top-layer">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
            </footer>

            <script src="../js/hamburger.js"></script>
            <script src="../js/mainmenu.js"></script>

    </body>
</html>
