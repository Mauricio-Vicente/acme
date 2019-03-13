<?php

/*
 * Products Controller
 */
//session 
session_start();
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';
//Get the function library file
require_once '../library/functions.php';
// Get the array of categories
$categories = getCategories();
//var_dump($categories);
//exit;
// Build a navigation bar using the $categories array
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//create a catList
$catList = '<select name="categoryId">';
$catList .= " <option>Select a category</option>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=" . urlencode($category['categoryName']) . "' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    $categoryChoosed = (isset($categoryId) && $categoryId === $category['categoryId']) ? 'selected' : '';
    $catList .= '<option value="' . $category['categoryId'] . '" ' . $categoryChoosed . '>' . $category['categoryName'] . '</option>';
}
$navList .= '</ul>';
//echo $navList;
//exit;   
$catList .= '</select>';
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
//    if ($action == NULL) {
//        $action = 'home'; 
//    }
}

switch ($action) {
    //test navList
    // case 'something':
    // Case new category view
    case 'new-cat':
        include '../view/new-cat.php';
        break;

    // Case new product view
    case 'new-prod':
        include '../view/new-prod.php';
        break;
    // SUBMIT THE CATEGORY    
    case 'submit':

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
            include '../view/new-cat.php';
        } else {
            $message = "<p><b>Submission has failed<b>. Please try again.</p>";
            include '../view/new-cat.php';
            exit;
        }
        break;
    //    
    // Add a new product    
    case 'addProduct':

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

    //Modify Products
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        break;

    //Update the Products
    case 'updateProd':
        // Filter and store the data
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($categoryId) || empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($invVendor) || empty($invStyle)) {
            $message = '<p>Please complete all information for the update item! Double check the category of the item.</p>';
            include '../view/prod-update.php';
            exit;
        }

        $updateResult = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId);
        if ($updateResult) {
            $message = "<p>Congratulations, $invName was successfully UPDATED.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Sorry, but product updating was Unsucessful.</p>";
            include '../view/prod-update.php';
            exit;
        }

        break;
    //Case delete
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;

    //Case deleteProd
    case 'deleteProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations, $invName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invName was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;
    //Case Category Name  
    case 'category':
        $category = filter_input(INPUT_GET, 'type',FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($category);
        if(!count($products)){
            $message = "<p class='notice'>Sorry, no $category products could be found.</p>";
        } else {
            $prodDisplay =  buildProductsDisplay($products);
        }
        
        include '../view/category.php';
        break;
                
    //Case product manegment view
    default:
        $products = getProductBasics();
        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }
        include '../view/prod-mgmt.php';
        break;
}



















 