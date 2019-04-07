<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title>Delete  Reviews | ACME Inc. </title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/>
        <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
    </head>
    <body>
        <header class="top-layer">
            <?php require '../common/header.php'; ?>
            <nav>
                <?php echo $navList; ?>
            </nav>
        </header>
        
        <main class="top-layer">
            <h1><?php if(isset($specificReview['invName'])){ echo "Delete $specificReview[invName] Review ";} elseif(isset($invName)) { echo $invName; }?></h1>

            <div class="req_password"> The delete is permanent. Please confirm review deletion. </div>

            <div class="req_password">            
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>

            <form  method="post" action="/acme/reviews/">
                <fieldset>
                    <label>Delete Review</label><textarea  name="reviewText" id="reviewText" readonly  required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($specificReview['reviewText'])) {echo $specificReview['reviewText']; }?></textarea>
                <input type="submit" value="Delete Review" class="reviewBtn">
                </fieldset>
                <input type="hidden" name="action" value="deleteReview">
                <input type="hidden" name="reviewId" value="<?php if(isset($specificReview['reviewId'])){echo $specificReview['reviewId'];} else if(isset($reviewId)){echo $reviewId;}?>">
            </form>

        </main>
        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>

    </body>
</html>


