<?php
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
        <link href="/acme/css/normalize.css" rel="stylesheet"  type="text/css" media="screen">    
        <link href="/acme/css/style.css" rel="stylesheet"  type="text/css" media="screen">  
        <title><?php
            if (isset($prodInfo['invName'])) {
                echo "Modify $prodInfo[invName] ";
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

<!--            <h1><?php echo $prodDisplay['invId']; ?></h1>-->
<!--            <h2 class='cat-head'><?php
//               
//                if (isset($prodDisplay)) {
//                    echo $prodDisplay['invName'];
//                } else {
//                    echo "Unknown Product";
//                }
//                ?></h2>-->
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <div id='prod-detail'><?php
                if (isset($prodDetail)) {
                    echo $prodDetail;
                }
                ?></div>
        </main>            

        <footer>
            <hr>
          <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

    </body>
</html>

