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
// Get the array of categories
$categories = getCategories();
//var_dump($categories);
//exit;
//create a catList

$catList = '<select name="category">';
  
  <option value="">Cannon</option>
  <option value="fiat"></option>
  <option value="audi">Audi</option>
</select>


// Build a navigation bar using the $categories array
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
 $navList .= "<li><a href='/acme/index.php?action=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";

$catList = '<option value="' . $category['categoryName'] . '">' . $category['categoryName'] . '</option>';
}
$navList .= '</ul>';
//echo $navList;
//exit;       

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');
//    if ($action == NULL) {
//        $action = 'home'; 
//    }
}
switch ($action) {
   case 'something':
       break;
   default:
       include 'view/home.php';
}

   

