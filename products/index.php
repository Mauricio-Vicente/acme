<?php

/*
 * PRODUCTS CONTROLLER
 */
// Create or access a Session
session_start();
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once'../model/reviews-model.php';
require_once'../model/accounts-model.php';
// Get the array of categories
$categories = getCategories();
// Build a navigation bar using the $categories array
$navList = buildNav($categories);
$catList = buildCatList($categories);
// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'new-prod':
        include '../view/new-prod.php';
        break;
    case 'submit-new-prod':
        $invName = filter_input(INPUT_POST, 'invName');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invSize = filter_input(INPUT_POST, 'invSize');
        $invWeight = filter_input(INPUT_POST, 'invWeight');
        $invLocation = filter_input(INPUT_POST, 'invLocation');
        $categoryId = filter_input(INPUT_POST, 'categoryId');
        $invVendor = filter_input(INPUT_POST, 'invVendor');
        $invStyle = filter_input(INPUT_POST, 'invStyle');
        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = "<p><b>Please provide information for all empty form fields.<b></p>";
            include '../view/new-prod.php';
            exit;
        }
        // Send the data to the model
        $prodOutcome = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);
        // Check and report the result
        if ($prodOutcome === 1) {
            $message = "<p class='feedback'>Product has been added. Thank you.</p>";
            include '../view/prod-mgmt.php';
        } else {
            $message = "<p class='feedback'>Product entry has failed. Please try again.</p>";
            include '../view/new-prod.php';
            exit;
        }
        break;

    case 'productView':
        include '../view/category.php';
        break;

    case 'categoryView':
        include '../view/category.php';
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
    case 'updateProd':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $validPrice = checkPrice($invPrice);
        // Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($validPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = '<p class="result">*Please provide information for all empty form fields.</p>';
            include '../view/prod-update.php';
            exit;
        }
// Send the data to the model
        $updateResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId);
// Check and report the result
        if ($updateResult) {
            $message = "<p class='result'>Congratulations, $invName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p class='result'>Sorry, but updating the product was unsucessful.</p>";
            include '../view/prod-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;
    case 'deleteProd':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
// Send the data to the model
        $deleteResult = deleteProduct($invId);
// Check and report the result
        if ($deleteResult) {
            $message = "<p class='result'> $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p class='result'> Error: $invName was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;
    case 'category':
        $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($categoryName);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $categoryName products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        break;
    case 'new-cat':
        include '../view/new-cat.php';
        break;
    // SUBMIT THE CATEGORY    
    case 'submit-new-cat':
        $categoryName = filter_input(INPUT_POST, 'categoryName');
        //Check for missing data
        if (empty($categoryName)) {
            $message = '<p>Please provide the category name.<</p>';
            include '../view/new-cat.php';
            exit;
        }
        //Send the data to the model
        $catOutcome = addCategory($categoryName);
        //Check and report the result
        if ($catOutcome === 1) {
            $message = "<p>Success! Category has been added.</p>";
            header('location: /acme/products/?action=new-cat');
        } else {
            $message = "<p><b>Submission has failed<b>. Please try again.</p>";
            include '../view/new-cat.php';
            exit;
        }
        break;
    case 'prod-details':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $products = getProductInfo($invId);
        $thumbnail = getThumbnail($invId);
        $reviews = getReviews($invId);
        $reviewArray = getReviewInfo($clientId);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $invName could be found.</p>";
        } else {
            $prodDetailDisplay = buildProductsDetails($products);
            $displayThumbnail = buildThumbnailDisplay($thumbnail);
            $allReviews = buildAllReviews($reviews);
        }

        if (isset($_SESSION['loggedin'])) {
            $reviewDisplay = buildReviewDisplay($products);
        }
        include '../view/prod-detail.php';
        break;
    default:
        $products = getProductBasics();
        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td><a href='/acme/products?action=prod-details&name=$product[invName]' title='Click to see details'>$product[invName]</a></td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="result">Sorry, no products were returned.</p>';
        }
        include '../view/prod-mgmt.php';
        break;
} 