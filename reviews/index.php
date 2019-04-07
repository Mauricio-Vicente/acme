<?php

/*
 * REVIEWS CONTROLLER
 */
session_start();
require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/acme-model.php';
require_once '../model/accounts-model.php';
require_once'../model/reviews-model.php';
require_once'../model/products-model.php';
require_once'../model/uploads-model.php';
$categories = getCategories();
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
// Code to deliver the views will be here
switch ($action) {
    case 'addReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $products = getProductInfo($invId);
        $thumbnail = getThumbnail($invId);
        $reviews = getReviews($invId);
        $clientInfo = getReviewInfo($clientId);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $invName could be found.</p>";
        } else {
            $allReviews = buildAllReviews($reviews);
            $prodDetailDisplay = buildProductsDetails($products);
            $displayThumbnail = buildThumbnailDisplay($thumbnail);
        }
        if (isset($_SESSION['loggedin'])) {
            $reviewDisplay = buildReviewDisplay($products);
        }
        if (empty($reviewText)) {
            $_SESSION['message'] = '<p class="result2">*Please provide a review before submitting.</p>';
            include '../view/prod-detail.php';
            exit;
            $addReview = insertReview($reviewId, $reviewText, $reviewDate, $invId, $clientId);
            if ($addReview === 1) {
                $_SESSION['message'] = "<p class='result2'>You successfully added a review.</p>";
            } else {
                $message = "<p class='result'>Sorry, but adding the review  was unsucessful.</p>";
                exit;
            }
        }
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $invName could be found.</p>";
        } else {
            $allReviews = buildAllReviews($reviews);
            $prodDetailDisplay = buildProductsDetails($products);
            $displayThumbnail = buildThumbnailDisplay($thumbnail);
        }
        if (isset($_SESSION['loggedin'])) {
            $reviewDisplay = buildReviewDisplay($products);
        }
        include '../view/prod-detail.php';
        break;
    
    case 'editReview':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $specificReview = getSpecificReview($reviewId);
        if (count($specificReview) < 1) {
            $message = 'Sorry, no reviews could be found.';
        }
        include '../view/rev-edit.php';
        exit;
        break;
    case 'updateReview':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        if (empty($reviewText)) {
            $message = '<p class = "result">*Please edit your review before submitting.</p>';
            include '../view/rev-edit.php';
            exit;
        }
        $reviewUpdate = updateReview($reviewId, $reviewText);
        if ($reviewUpdate) {
            $_SESSION['message2'] = "<p class='result2'>Your review has been updated.</p>";
            header('location: /acme/accounts/');
            exit;
        } else {
            $message = "<p class ='result'>Sorry, but your review was not updated.</p>";
            include '../view/rev-edit.php';
            exit;
        }
        break;
    case 'deleteView':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $specificReview = getSpecificReview($reviewId);
        if (count($specificReview) < 1) {
            $message = 'Sorry, no reviews could be found.';
        }
        include '../view/rev-delete.php';
        exit;
        break;
    case 'deleteReview':
        // Filter and store the data

        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
// Send the data to the model
        $deleteResult = deleteReview($reviewId);
// Check and report the result
        if ($deleteResult) {
            $_SESSION['message2'] = "<p class='result2'> Your review was successfully deleted.</p>";
            header('location: /acme/accounts/');
            exit;
        } else {
            $_SESSION['message2'] = "<p class='result2'> Error: Sorry the review was not deleted.</p>";
            header('location: /acme/accounts/');
            exit;
        }
        break;
    default:
        include '../view/prod-detail.php';
        exit;
        break;
}
            

