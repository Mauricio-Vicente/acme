<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title><?php
            if (isset($prodInfo['invName'])) {
                echo "Delete $prodInfo[invName] ";
            } elseif (isset($invName)) {
                echo $invName;
            }
            ?> | Acme, Inc</title>
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
            <div id="addCat">

                <h1><?php
                    if (isset($prodInfo['invName'])) {
                        echo "Delete $prodInfo[invName] ";
                    } elseif (isset($invName)) {
                        echo $invName;
                    }
                    ?></h1>
                <p id="delconf">Confirm Product Deletion. The delete is permanent.</p>


                <form method="post" action="/acme/products/">
                    <fieldset>

                        <label for="invName">Product Name</label>
                        <input type="text" readonly name="invName" id="invName" <?php
                        if (isset($prodInfo['invName'])) {
                            echo "value='$prodInfo[invName]'";
                        }
                        ?>>

                        <label for="invDescription">Product Description</label>
                        <textarea name="invDescription" readonly id="invDescription"><?php
                            if (isset($prodInfo['invDescription'])) {
                                echo $prodInfo['invDescription'];
                            }
                            ?></textarea>

                        <label>&nbsp;</label> 
                        <input type="submit" class="regbtn" name="submit" value="Delete Product">

                        <input type="hidden" name="action" value="deleteProd">
                        <input type="hidden" name="invId" value="<?php
                        if (isset($prodInfo['invId'])) {
                            echo $prodInfo['invId'];
                        }
                        ?>">

                    </fieldset>
                </form>
            </div>
        </main>

        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>
        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>


    </body>
</html>

