<?php
/*
 * Custom Functions Library
 */
/*
 * server side validation for email inputs 
*/
function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
} 
/*
 * server side validation for password inputs 
 */

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $clientPassword);
}

//Build the Navigation List
function buildNave(){
    $categories = getCategories();
    $navList = '<ul>';
    $navlist .= "<li><a rfer='/acme/index.php' title='View the Acme home page'>Home</a></li>";
    foreach ($categories as $category){
        $navList .= "<li><a rfer='/acme/products/index.php?action=category&amp;type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    $navList = '<ul>';
    return $navList;
}

//Build a display of products within an unordered list.
function buildProductsDisplay($products){
 $pd = '<ul id="prod-display">';
 foreach ($products as $product) {
  $pd .= '<li>';
  $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
  $pd .= '<hr>';
  $pd .= "<h2>$product[invName]</h2>";
  $pd .= "<span>$product[invPrice]</span>";
  $pd .= '</li>';
 }
 $pd .= '</ul>';
 return $pd;
}





