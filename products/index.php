<?php
/* 
 * Products controller
 */

// Get the database connection file, the acme Model (for the getCategories() function), and the products Model
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../library/functions.php';



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
//$catList = '<select name="catListDropDown" form="productForm">';
//foreach ($categories as $category) {
//    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
//}
//$catList .= '</select>';
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
            //Individual assignment and filters instead of an array with filters as per assignment
            $catListDropDown    = filter_input( INPUT_POST, 'catListDropDown',    FILTER_SANITIZE_STRING );
            $productName        = filter_input( INPUT_POST, 'productName',        FILTER_SANITIZE_STRING );
            $productDescription = filter_input( INPUT_POST, 'productDescription', FILTER_SANITIZE_STRING );
            $productImage       = filter_input( INPUT_POST, 'productImage',       FILTER_SANITIZE_STRING );
            $productThumbnail   = filter_input( INPUT_POST, 'productThumbnail',   FILTER_SANITIZE_STRING );
            $productPrice       = filter_input( INPUT_POST, 'productPrice',       FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $productStock       = filter_input( INPUT_POST, 'productStock',       FILTER_SANITIZE_NUMBER_INT );
            $productSize        = filter_input( INPUT_POST, 'productSize',        FILTER_SANITIZE_NUMBER_INT );
            $productWeight      = filter_input( INPUT_POST, 'productWeight',      FILTER_SANITIZE_NUMBER_INT );
            $productLocation    = filter_input( INPUT_POST, 'productLocation',    FILTER_SANITIZE_STRING );
            $productStyle       = filter_input( INPUT_POST, 'productStyle',       FILTER_SANITIZE_STRING );
            $productVendor      = filter_input( INPUT_POST, 'productVendor',      FILTER_SANITIZE_STRING );
            
            
            if( empty($catListDropDown)      || empty($productName)     || empty($productDescription) || empty($productImage)    ||
                    empty($productThumbnail) || empty($productPrice)    || empty($productStock)       || empty($productSize)     ||
                    empty($productWeight)    || empty($productLocation) || empty($productStyle)       || empty($productVendor)     ) {
                $message = "<h2 id='message'>Please provide information for all empty form fields.</h2>";
                include '../view/new-prod.php';
                exit;
            }
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