<?php

/* 
 * Model for adding, editing and deleting reviews
 */


// INSERT a review
function addReview( $reviewText, $reviewDate, $invId, $clientId ){
    //Param: String reviewText, String reviewDate, Integer invId, Integer clientId
    //Return: Integer rowsChanged => 0 fail, 1 success
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'INSERT INTO reviews
            ( reviewText
            , reviewDate
            , invId
            , clientId )
            VALUES
            ( :reviewText
            , :reviewDate
            , :invId
            , :clientId )';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get Reviews by inventory ID
function getItemReviews($invId) {
    // Param:   integer inventory ID
    // Return:  $itemReviews[row][columns]:: rId, rText, rDate, cFirstname, cLastname:: Returns most recent review first
    $db = acmeConnect();
    $sql = 'SELECT r.reviewId, r.reviewText, r.reviewDate, c.clientFirstname, c.clientLastname FROM reviews r INNER JOIN clients c ON c.clientId = r.clientId WHERE r.invId = :invId ORDER BY r.reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $itemReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $itemReviews;
}

// Get product information by client ID
function getClientReviews($clientId){
    // Param:   integer client ID
    // Return:  $clientReviews[row][column]
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews WHERE clientId = :clientId';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $clientReviews;
}

// Get specific review by review ID
function getReview($reviewId){
    // Param:   integer review ID
    // Return:  $specificReview[columns]
    $db = acmeConnect();
    $sql = 'SELECT * FROM reviews WHERE reviewId = :reviewId';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $review;
}

// Update a review using review ID
function updateReview( $reviewId, $reviewText, $reviewDate, $invId, $clientId ){
    //Param: Int reviewId, Str reviewText, Str reviewDate, Int invId, Int clientId
    //Return: Integer rowsChanged => 0 fail, 1 success
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'UPDATE reviews SET
              reviewText = :reviewText
            , reviewDate = :reviewDate
            , invId = :invId
            , clientId = :clientId
            WHERE reviewId = :reviewId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Delete a review using review ID
function deleteReview($reviewId){
    //Param: Int reviewId
    //Return: Int rowsChanged => 0 fail, 1 success
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

