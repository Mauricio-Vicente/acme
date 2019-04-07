
<?php

// Accounts controller
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == null) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
// Create or access a Session
session_start();
// Get the database connection file
require_once '../library/connections.php';
// Get functions
require_once '../library/functions.php';
//Get the Functions file
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
//get model reviews
require_once '../model/reviews-model.php';
// Get array of categories from acme-model
$categories = getCategories();
// Build a navigation bar using the $categories array
$navList = buildNav($categories);

switch ($action) {
    case 'registration':
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);
        // Check for existing email address in the table
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /acme/accounts/?action=login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'login':
        if (isset($_SESSION['loggedin'])) {
            include '../view/admin.php';
            exit;
        }
        
        // Filter and store the data
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);
// Check for missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
             if (isset($reviewList)) {
                echo $reviewList;
            } else {
                echo '<p class="result2">Please, leave a review for your favorite product.</p>';
            }
        }
        
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
// Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
// If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p>Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        } else {
            $message = '<p>Login Successful</p>';
        }
// A valid user exists, log them in
        $_SESSION['loggedin'] = true;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
// Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Create the welcome message based on $clientData;
        $_SESSION['welcomeMessage'] = "Welcome $clientData[clientFirstname]";
        // Delete $_COOKIE['firstname']
        setcookie('firstname', '', time() - 3600, '/');
// Send them to the admin view
        include '../view/admin.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: /acme/');
        break;
    case 'update':
        $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientId = $_SESSION['clientData']['clientId'];
        include '../view/client-update.php';
        break;
    case 'updateAccount':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId');
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientId)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }
        // check if email is different, check to make sure it doesn't already exist
        if ($clientEmail !== $_SESSION['clientData']['clientEmail']) {
            // Check if email matches standards
            $clientEmail = checkEmail($clientEmail);
            //Check if email exists already
            $existingEmail = checkExistingEmail($clientEmail);

            if ($existingEmail) {
                $message = '<p class="notice">That email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }
        $returnValue = updateAccount($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($returnValue == 1) {
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<span>Account information changed correctly</span>";
        } else {
            $message = "<p>Account information not changed</p>";
        }
        include '../view/admin.php';
        break;
    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $passChange = updatePassword($clientId, $hashedPassword);
        if ($passChange == 1) {
            $message = "Password changed";
        } else {
            $message = "Password not changed";
        }

        include '../view/client-update.php';
        break;
    default:
        $clientId = $_SESSION['clientData']['clientId'];
        $reviewArray = getReviewInfo($clientId);
         if (count($reviewArray) > 0) {
        $reviewList = '<table>';
        $reviewList .= '<thead>';
        $reviewList .= '<tr><th>Date</th><th>Reviews</th><td>&nbsp;</td></tr>';
        $reviewList .= '</thead><tbody>';
        foreach ($reviewArray as $review) {
            $madeDate = $review['reviewDate'];
            $stringDate = strtotime($madeDate);
            $displayDate = date('m.d.y', ($stringDate));
            $reviewList .= "<tr><td>$displayDate</td>";
            $reviewList .= "<td>$review[reviewText]</td>";
            $reviewList .= "<td><a href='/acme/reviews?action=editReview&id=$review[reviewId]' title='Click to modify'>Edit</a></td>";
            $reviewList .= "<td><a href='/acme/reviews?action=deleteView&id=$review[reviewId]' title='Click to delete'>Delete</a></td></tr>";
        }
        $reviewList .= '</tbody></table>';
         }else {
             $message = "<hr><br><p class='result'>Please enter  a review on our product pages. We would love to hear from you.</p>";
         }
        include '../view/admin.php';
        break;
}