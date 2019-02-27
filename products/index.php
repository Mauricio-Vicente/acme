<?php

/*
 * Products Controller
 */
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model for use as needed
require_once '../model/products-model.php';
//Get the function library file
//require_once '../library/functions.php';
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
    $categoryChoosed = (isset($categoryId)  && $categoryId === $category['categoryId']) ? 'selected' : '';
    $catList .= '<option value="' . $category['categoryId'] . '" '. $categoryChoosed .'>' . $category['categoryName'] . '</option>';
   
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
            
            exit;
            $categoryName = filter_input(INPUT_POST, 'categoryName');

            //Check for missing data
            if (empty($categoryName)) {
                $message = '<p>Please provide the category name.<</p>';
                include '../view/new-cat.php';
                
            }

            //Send the data to the model
            $catOutcome = newCat($categoryName);

            //Check and report the result
            if ($catOutcome === 1) {
                $message = "<p>Success! Category has been added.</p>";
                include 'view/new-cat.php';
                exit;
            } else {
                $message = "<p><b>Submission has failed<b>. Please try again.</p>";
                include '../view/new-cat.php';
                exit;
            }
             var_dump("ual");
            exit;
            break;
            
        // Add a new product    
        case 'addProduct':

            $invName = filter_input(INPUT_POST, 'invName');
            $invDescription = filter_input(INPUT_POST, 'invDescription');
            $invImage = filter_input(INPUT_POST, 'invImage');
            $invThumbnail = filter_input(INPUT_POST, 'invThubnail');
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
            $prodOutcome = newProd($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

            // Check and report the result
            if ($prodOutcome === 1) {

                $message = "<p class='feedback'>Product has been added. Thank you.</p>";
                include '../view/prod-mgmt.php';
                exit;
            } else {
                $message = "<p class='feedback'>Product entry has failed. Please try again.</p>";
                include '../view/new-prod.php';
                exit;
            }
              break;
        //Case product manegment view
        default:
            include '../view/prod-mgmt.php';
            break;
    }



















 