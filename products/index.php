<?php
/* 
 * Products controller
 */

// Create or access a Session
session_start();

// Get the database connection file, the acme Model (for the getCategories() function), and the products Model
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../library/functions.php';

if(isset($_SESSION['loggedin'])){
    $headerAccount = createHeaderAccount(true);
} else {
    $headerAccount = createHeaderAccount(false);
}

////////////////////////////////////////////////////////////////////////////////
// Pass list of Categories to createNav, to generate the navigation
$categories = getCategories();
$navList = createNav($categories);

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
            
            
        case 'mod':
            $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $prodInfo = getProductInfo($invId);
            if(count($prodInfo)<1){
                $message = 'Sorry, no product information could be found.'; // MAYBE CHECK ON THIS THIGN BECAUSE IT MIGHT NEED TAGS
            }
            
            include '../view/prod-update.php';
            exit;
        break;

        
        
        case 'updateProd':
            //Copypasted from the insert product case above
            $catListDropDown    = filter_input( INPUT_POST, 'catListDropDown',    FILTER_SANITIZE_STRING );
            $invName            = filter_input( INPUT_POST, 'invName',            FILTER_SANITIZE_STRING );
            $invDescription     = filter_input( INPUT_POST, 'invDescription',     FILTER_SANITIZE_STRING );
            $invImage           = filter_input( INPUT_POST, 'invImage',           FILTER_SANITIZE_STRING );
            $invThumbnail       = filter_input( INPUT_POST, 'invThumbnail',       FILTER_SANITIZE_STRING );
            $invPrice           = filter_input( INPUT_POST, 'invPrice',           FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock           = filter_input( INPUT_POST, 'invStock',           FILTER_SANITIZE_NUMBER_INT );
            $invSize            = filter_input( INPUT_POST, 'invSize',            FILTER_SANITIZE_NUMBER_INT );
            $invWeight          = filter_input( INPUT_POST, 'invWeight',          FILTER_SANITIZE_NUMBER_INT );
            $invLocation        = filter_input( INPUT_POST, 'invLocation',        FILTER_SANITIZE_STRING );
            $invStyle           = filter_input( INPUT_POST, 'invStyle',           FILTER_SANITIZE_STRING );
            $invVendor          = filter_input( INPUT_POST, 'invVendor',          FILTER_SANITIZE_STRING );
            $invId              = filter_input( INPUT_POST, 'invId',              FILTER_SANITIZE_NUMBER_INT);
            
            
            if( empty($catListDropDown)      || empty($productName)     || empty($productDescription) || empty($productImage)    ||
                    empty($productThumbnail) || empty($productPrice)    || empty($productStock)       || empty($productSize)     ||
                    empty($productWeight)    || empty($productLocation) || empty($productStyle)       || empty($productVendor)     ) {
                $message = "<h2 id='message'>Please provide information for all empty form fields.</h2>";
                include '../view/prod-update.php';
                exit;
            }
            // Send Product Data to the Model
            $updateResult =  updateProduct( $catListDropDown, $productName, $productDescription
                                      , $productImage, $productThumbnail, $productPrice
                                      , $productStock, $productSize, $productWeight
                                      , $productLocation, $productStyle, $productVendor, $invId );
            // Make sure it changed just one row (the one we added)
            if($updateResult === 1) {
                    $message = "<h2 id='message'>Congratulations, ".$productName." was successfully updated.</h2>";
                    $_SESSION['message'] = $message;
                    header('location: /acme/products/');
                    exit;
                } else {
                    $message = "<h2 id='message'>".$productName." update failed.</h2>";
                    include '../view/prod-update.php';
                    exit;
                }
        break;
        
    
    
	default:
            $products = getProductBasics();
            if( count($products) > 0 ) {
                $prodList = '<table>';
                $prodList .= '<thead>';
                $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
                $prodList .= '</thead>';
                $prodList .= '<tbody>';
                foreach ( $products as $product ) {
                    $prodList .= "<tr><td>$product[invName]</td>";
                    $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                    $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
                }
                    $prodList .= '</tbody></table>';
                } else {
                    $message = '<p class="notify">Sorry, no products were returned.</p>';
            }
            
            
            include "../view/prod-mgmt.php";
}
////////////////////////////////////////////////////////////////////////////////