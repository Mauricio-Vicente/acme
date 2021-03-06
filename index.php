<?php

/*
 * Acme Controller
 */
// Create or access a Session
session_start();
// Get the database connection file
require_once 'library/connections.php';
//Get the Functions file
require_once 'library/functions.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';

// Get the array of categories
$categories = getCategories();
//var_dump($categories);
//exit;
$navList = buildNav($categories);
// Build a navigation bar using the $categories array
//$navList = '<ul>';
//$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
//foreach ($categories as $category) {
// $navList .= "<li><a href='/acme/products/?action=category&type=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//}
//$navList .= '</ul>';
//echo $navList;
//exit;     
// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

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
       
  

