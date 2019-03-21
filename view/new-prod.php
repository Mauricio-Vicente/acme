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
            <div id="addCat">

                 <h1>Add Product</h1>
                <p>Add a new product below. All fields are required!</p>


                <form method="post" action="/acme/products/index.php">

                    <?php
                    if (isset($message)) {
                        echo $message;
                    }
                    ?>
                <!--catList-->
                    <?php echo $catList; ?><br><br>
                <!--catList End-->

                    <label for="invName">Product Name</label><br>
                    <input required type="text" name="invName" id="invName"><br>

                    <label for="invDescription">Product Description</label><br>
                    <input required type="text" name="invDescription" id="invDescription"><br>

                    <label for="invImage">Product Image</label><br>
                    <input required type="text" name="invImage" id="invImage"><br>

                    <label for="invThumbnail">Product Thumbnail</label><br>
                    <input required type="text" name="invThumbnail" id="invThumbnail"><br>

                    <label for="invPrice">Product Price</label><br>
                    <input required type="text" name="invPrice" id="invPrice"><br>

                    <label for="invStock">Product Stock</label><br>
                    <input required type="text" name="invStock" id="invStock"><br>

                    <label for="invSize">Product Size</label><br>
                    <input required type="text" name="invSize" id="invSize"><br>

                    <label for="invWeight">Product Weight</label><br>
                    <input required type="text" name="invWeight" id="invWeight"><br>

                    <label for="invLocation">Product Location</label><br>
                    <input required type="text" name="invLocation" id="invLocation"><br>

                    <label for="categoryId">Category ID</label><br>
                    <input required type="text" name="categoryId" id="categoryId"><br>

                    <label for="invVendor">Product Vendor</label><br>
                    <input required type="text" name="invVendor" id="invVendor"><br>

                    <label for="invStyle">Product Style</label><br>
                    <input required type="text" name="invStyle" id="invStyle"><br>
                    
                    <input type="submit" name="submit" value="Update Product" class="sButton"><br>
                    <input type="hidden" name="action" value="addProduct">

                </form>
            </div>
        </main>

       <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

    </body>
</html>

