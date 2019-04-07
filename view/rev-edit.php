<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title>Edit Reviews | ACME Inc. </title>
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
            <h1><?php if(isset($specificReview['invName'])){ echo "Edit $specificReview[invName] Review ";} elseif(isset($invName)) { echo $invName; }?></h1>

            <div class="req_password">            
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </div>

            <form  method="post" action="/acme/reviews/">
                <fieldset>
                    <label>Product Review</label><textarea  name="reviewText" id="reviewText" placeholder="Description" required><?php if(isset($reviewText)){ echo $reviewText; } elseif(isset($specificReview['reviewText'])) {echo $specificReview['reviewText']; }?></textarea>
                <input type="submit" value="Submit Edited Review" class="reviewBtn">
                </fieldset>
                <input type="hidden" name="action" value="updateReview">
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


