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

// Get product information by inventory ID
function getProductInfo($invId){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    return $prodInfo;
}


function updateProduct( $catListDropDown, $invName, $invDescription, $invImage, $invThumbnail, $invPrice
                   , $invStock, $invSize, $invWeight, $invLocation, $invStyle, $invVendor, $invId ){
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'UPDATE inventory SET
              categoryId = :catListDropDown
            , invName = :invName
            , invDescription = :invDescription
            , invImage = :invImage
            , invThumbnail = :invThumbnail
            , invPrice = :invPrice
            , invStock = :invStock
            , invSize = :invSize
            , invWeight = :invWeight
            , invLocation = :invLocation
            , invStyle = :invStyle
            , invVendor = :invVendor
            WHERE invId = :invId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':catListDropDown', $catListDropDown, PDO::PARAM_INT);
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', strval($invPrice), PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

//This will delete a product
function deleteProduct($invId){
    
    $db = acmeConnect();

    // The SQL statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    
    // Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    
    // The lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    
    // Close the database interaction
    $stmt->closeCursor();
    
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductsByCategory($type){
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
    
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
    $stmt->execute();
    
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt->closeCursor();
    return $products;
}