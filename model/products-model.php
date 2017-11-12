<?php

// Function 1 should Add the new category to the acme CATEGORIES table using PDO


// Add a new product to the acme INVENTORY table using PDO 
function addProduct( $catListDropDown, $productName, $productDescription, $productImage, $productThumbnail, $productPrice
                   , $productStock, $productSize, $productWeight, $productLocation, $productStyle, $productVendor ){
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'INSERT INTO inventory
            ( categoryId
            , invName
            , invDescription
            , invImage
            , invThumbnail
            , invPrice
            , invStock
            , invSize
            , invWeight
            , invLocation
            , invStyle
            , invVendor )
            VALUES
            ( :catListDropDown
            , :productName
            , :productDescription
            , :productImage
            , :productThumbnail
            , :productPrice
            , :productStock
            , :productSize
            , :productWeight
            , :productLocation
            , :productStyle
            , :productVendor )';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':catListDropDown', $catListDropDown, PDO::PARAM_INT);
    $stmt->bindValue(':productName', $productName, PDO::PARAM_STR);
    $stmt->bindValue(':productDescription', $productDescription, PDO::PARAM_STR);
    $stmt->bindValue(':productImage', $productImage, PDO::PARAM_STR);
    $stmt->bindValue(':productThumbnail', $productThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':productPrice', strval($productPrice), PDO::PARAM_STR);
    $stmt->bindValue(':productStock', $productStock, PDO::PARAM_INT);
    $stmt->bindValue(':productSize', $productSize, PDO::PARAM_INT);
    $stmt->bindValue(':productWeight', $productWeight, PDO::PARAM_INT);
    $stmt->bindValue(':productLocation', $productLocation, PDO::PARAM_STR);
    $stmt->bindValue(':productStyle', $productStyle, PDO::PARAM_STR);
    $stmt->bindValue(':productVendor', $productVendor, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


// Add a new category to the CATEGORIES table using PDO
function addCategory($categoryName){
    $db = acmeConnect();
    
    // The SQL statement
    $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The line replaces the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $products;
}