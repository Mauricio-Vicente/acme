<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /acme/');
    exit;
}
// Build the categories option list
$catList = '<select name="categoryId" id="categoryId" class="drop-down">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'";
    if (isset($categoryId)) {
        if ($category['categoryId'] === $categoryId) {
            $catList .= ' selected ';
        }
    } elseif (isset($prodInfo['categoryId'])) {
        if ($category['categoryId'] === $prodInfo['categoryId']) {
            $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width=device-width, initial-scale=1">
        <title><?php if (isset($prodInfo['invName'])) {
    echo "Modify $prodInfo[invName] ";
} elseif (isset($invName)) {
    echo $invName;
} ?> | Acme, Inc</title>
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

                <h1><?php if (isset($prodInfo['invName'])) {
    echo "Modify $prodInfo[invName] ";
} elseif (isset($invName)) {
    echo $invName;
} ?></h1>
                <p >Add a new product below. All fields are required!</p>


                <form method="post" action="/acme/products/index.php">

<?php
if (isset($message)) {
    echo $message;
}
?>
                    <?php echo $catList; ?><br><br>
                   
                    <label for="invName">Product Name</label><br>
                    <input type="text" name="invName" id="invName" required <?php if (isset($invName)) {
    echo "value='$invName'";
} elseif (isset($prodInfo['invName'])) {
    echo "value='$prodInfo[invName]'";
} ?>><br>

                    <label for="invDescription">Product Description</label><br>
                    <input type="text" name="invDescription" id="invDescription" required <?php if (isset($invDescription)) {
    echo "value='$invDescription'";
} elseif (isset($prodInfo['invDescription'])) {
    echo 'value=' . $prodInfo['invDescription'];
} ?>><br>

                    <label for="invImage">Product Image</label><br>
                    <input type="text" name="invImage" id="invName" required <?php if (isset($invImage)) {
    echo "value='$invImage'";
} elseif (isset($prodInfo['invImage'])) {
    echo "value='$prodInfo[invImage]'";
} ?>><br>

                    <label for="invThumbnail">Product Thumbnail</label><br>
                    <input type="text" name="invThumbnail" id="invThumbnail" required <?php if (isset($invThumbnail)) {
    echo "value='$invThumbnail'";
} elseif (isset($prodInfo['invThumbnail'])) {
    echo "value='$prodInfo[invThumbnail]'";
} ?>><br>

                    <label for="invPrice">Product Price</label><br>
                    <input type="text" name="invPrice" id="invPrice" required <?php if (isset($invPrice)) {
    echo "value='$invPrice'";
} elseif (isset($prodInfo['invPrice'])) {
    echo "value='$prodInfo[invPrice]'";
} ?>><br>

                    <label for="invStock">Product Stock</label><br>
                    <input type="text" name="invStock" id="invPrice" required <?php if (isset($invStock)) {
    echo "value='$invStock'";
} elseif (isset($prodInfo['invStock'])) {
    echo "value='$prodInfo[invStock]'";
} ?>><br>

                    <label for="invSize">Product Size</label><br>
                    <input type="text" name="invSize" id="invSize" required <?php if (isset($invSize)) {
    echo "value='$invSize'";
} elseif (isset($prodInfo['invSize'])) {
    echo "value='$prodInfo[invSize]'";
} ?>><br>

                    <label for="invWeight">Product Weight</label><br>
                    <input type="text" name="invWeight" id="invWeight" required <?php if (isset($invWeight)) {
    echo "value='$invWeight'";
} elseif (isset($prodInfo['invWeight'])) {
    echo "value='$prodInfo[invWeight]'";
} ?>><br>

                    <label for="invLocation">Product Location</label><br>
                    <input type="text" name="invLocation" id="invLocation" required <?php if (isset($invLocation)) {
    echo "value='$invLocation'";
} elseif (isset($prodInfo['invLocation'])) {
    echo "value='$prodInfo[invLocation]'";
} ?>><br>

                    <label for="categoryId">Category ID</label><br>
                    <input type="text" name="categoryId" id="categoryId" required <?php if (isset($categoryId)) {
    echo "value='$categoryId'";
} elseif (isset($prodInfo['categoryId'])) {
    echo "value='$prodInfo[categoryId]'";
} ?>><br>

                    <label for="invVendor">Product Vendor</label><br>
                    <input type="text" name="invVendor" id="invVendor" required <?php if (isset($invVendor)) {
    echo "value='$invVendor'";
} elseif (isset($prodInfo['invVendor'])) {
    echo "value='$prodInfo[invVendor]'";
} ?>><br>

                    <label for="invStyle">Product Style</label><br>
                    <input type="text" name="invStyle" id="invStyle" required <?php if (isset($invStyle)) {
    echo "value='$invStyle'";
} elseif (isset($prodInfo['invStyle'])) {
    echo "value='$prodInfo[invStyle]'";
} ?>><br>

                    <input type="submit" name="submit" value="Update Product" class="sButton"><br>
                    <input type="hidden" name="action" value="updateProd">
                    <input type="hidden" name="invId" value="<?php if (isset($prodInfo['invId'])) {
    echo $prodInfo['invId'];
} elseif (isset($invId)) {
    echo $invId;
} ?>">

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

