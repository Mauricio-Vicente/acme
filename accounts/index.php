<?php

/*
 * Accounts Controller
 */

// Get the database connection file
require_once '../library/connections.php';
//Get the Functions
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of categories
$categories = getCategories();

// Build a navigation bar using the $categories array
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li><a href='/acme/index.php?action=urlencode($category[categoryName])' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
// Code to deliver the views will be here

    case 'register':
// Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $checkEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);

// Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($checkEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        $existingEmail = checkExistingEmail($clientEmail);

// Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);


// Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'login':
        $uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
        $pwd = filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING);
        $checkpwd = checkPassword($pwd);
        // Check for missing data
        if (empty($uname) || empty($pwd)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
        }

        include_once '../view/login.php';
        break;
    default:
}   
   
   
       

