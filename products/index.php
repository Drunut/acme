<?php
/* 
 * Products controller
 */

// Get the database connection file, the acme Model (for the getCategories() function), and the products Model
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';



////////////////////////////////////////////////////////////////////////////////
// Create list of Categories for use in the navbar and new-prod View's dropdown
$categories = getCategories();

// Build a navigation bar
$navList = '<ul id="nav_ul">';
$navList .= "<li class='nav_li'><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
    $navList .= "<li class='nav_li'><a href='/acme/index.php?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

// Build a dropdown of categories for new-prod.php
$catList = '<select name="catListDropDown" form="productForm">';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
}
$catList .= '</select>';
////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////
// Page Control and Form Submission Logic


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
        //Page Navigation Cases
	case 'newCategory':
            include "../view/new-cat.php";
            break;
	case 'newProduct':
            include "../view/new-prod.php";
            break;
        
        // Form Submission Cases
        case 'createProduct':
            //There are a TON of keys here so it's cleaner to filter the whole POST array
            $formAction = filter_input_array(INPUT_POST);
            // Extract the array into variables
            extract($formAction);
            // Check the array if there are any empty fields.
            // We extract before this so we can replace filled-in fields
            foreach($formAction as $formItem){
                if(empty($formItem)){
                    $message = "<h2 id='message'>Please provide information for all empty form fields.</h2>";
                    include '../view/new-prod.php';
                    exit;
                }
            }
//             empty($catListDropDown) || empty($productName) || empty($productDescription) ||
//             empty($productImage) || empty($productThumbnail) || empty($productPrice) ||
//             empty($productStock) || empty($productSize) || empty($productWeight) ||
//             empty($productLocation) || empty($productStyle) || empty($productVendor)
            // Send Product Data to the Model
            $prodOutcome =  addProduct( $catListDropDown, $productName, $productDescription
                                      , $productImage, $productThumbnail, $productPrice
                                      , $productStock, $productSize, $productWeight
                                      , $productLocation, $productStyle, $productVendor );
            // Make sure it changed just one row (the one we added)
            if($prodOutcome === 1) {
                    $message = "<h2 id='message'>Congratulations, ".$productName." was successfully added.</h2>";
                    include '../view/new-prod.php';
                    exit;
                } else {
                    $message = "<h2 id='message'>".$productName." registration failed. Please try again.</h2>";
                    include '../view/new-prod.php';
                    exit;
                }
            break;
            
        case 'createCategory':
            //Check if there's a supplied category name
            if (empty($categoryName)){
                $message = "<h2 id='message'>Please provide a category name.</h2>";
                include '../view/new-cat.php';
                exit;
            }
            // Insert the new category into the database
            $catOutcome = addCategory( filter_input(INPUT_POST, 'categoryName') );
            // Check to see if the insert was successful
            if ($catOutcome === 1) {
                header( "Location: /acme/products/index.php" );
            } else {
                $message = "<h2 id='message'>".$categoryName." registration failed. Please try again.</h2>";
                include '../view/new-cat.php';
                exit;
            }
            break;
            
	default:
            include "../view/prod-mgmt.php";
}
////////////////////////////////////////////////////////////////////////////////