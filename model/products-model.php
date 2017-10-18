<?php

// Function 1 should Add the new category to the acme CATEGORIES table using PDO


// Add a new product to the acme INVENTORY table using PDO 
function addProduct(){
    $db = acmeConnect();
    
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}