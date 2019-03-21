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
        <link href="/acme/css/normalize.css" rel="stylesheet"  type="text/css" media="screen">    
        <link href="/acme/css/style.css" rel="stylesheet"  type="text/css" media="screen">  
        <title><?php
            if (isset($prodInfo['invName'])) {
                echo "Delete $prodInfo[invName] ";
            } elseif (isset($invName)) {
                echo $invName;
            }
            ?> | Acme, Inc</title>
    </head>
    <body>
        <header>
                <?php require '../common/header.php'; ?>
            <nav>
<?php echo $navList; ?>
            </nav>
        </header>
        <main>
            <div id="addCat">

                <h1><?php
                    if (isset($prodInfo['invName'])) {
                        echo "Delete $prodInfo[invName] ";
                    } elseif (isset($invName)) {
                        echo $invName;
                    }
                    ?></h1>
                <p>Confirm Product Deletion. The delete is permanent.</p>


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

        <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

    </body>
</html>

