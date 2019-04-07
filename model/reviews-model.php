<?php
/*
 * REVIEWS MODEL
 */
//Insert a New Review into database
function insertReview($reviewId, $reviewText, $reviewDate, $invId, $clientId) {
    $db = acmeConnect();
    $sql = 'INSERT INTO reviews (reviewId, reviewText, reviewDate, invId, clientId) VALUES (:reviewId, :reviewText, :reviewDate, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
//Get reviews written by a specific client
function getReviewInfo($clientId) {
    $db = acmeConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, clients.clientId, clientFirstname, clientLastname, inventory.invId, invName FROM reviews JOIN clients ON reviews.clientId = clients.clientId JOIN  inventory ON reviews.invId = inventory.invId WHERE clients.clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviewArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviewArray;
}
//Gets reviews for products
function getReviews($invId) {
    $db = acmeConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clients.clientId, clientFirstname, clientLastname FROM reviews  JOIN clients ON reviews.clientId = clients.clientId WHERE invId = :invId ORDER BY reviewDate DESC ';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}
//Get Basic review  information from database for update and delete processes
function getSpecificReview($reviewId) {
    $db = acmeConnect();
    $sql = 'SELECT reviewId, reviewText, inventory.invName FROM reviews JOIN inventory ON reviews.invId = inventory.invId WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $specificReview = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $specificReview;
}
//Update a specific review
function updateReview($reviewId, $reviewText) {
    $db = acmeConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText  WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
//Delete a specific review
function deleteReview($reviewId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}