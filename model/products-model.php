<?php

/*
 * Product Model
 * stores two functions, add products and add category
 */

//function that add a new category
function addCategory($categoryName) {
    //connect the database
    $db = acmeConnect();
    //SQL statement
    $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
    // Create the prepared statement using the connection created
    $stmt = $db->prepare($sql);

    // replace the placeholders in the SQL
    // first the actual values in the variables
    // and so notify the database about types of data
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    // Ask to database how many rows changed 
    $rowsChanged = $stmt->rowCount();
    // Close the connection
    $stmt->closeCursor();
    // Return the results
    return $rowsChanged;
}

function addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle) {
    // Create a connection object from the acme connection function
    $db = acmeConnect();
    // The SQL statement
    $sql = 'INSERT into inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle) '
            . 'VALUES ' . '(:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
    // Creates the prepared statement using the connection
    $stmt = $db->prepare($sql);
    // Below are the statements for making changes to the database
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    // Runs the prepared statement
    $stmt->execute();
    // Gets the data in database and stores it as an array in the $product variable
    $rowsChanged = $stmt->rowCount();
    // Closes the interaction with the database
    $stmt->closeCursor();
    // Send  array of data back to where the function
    return $rowsChanged;
}
