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
            try {
                //There are a TON of keys here so it's cleaner to filter the whole POST array, then extract
                //$formAction = array_filter($_POST, trim());
                $formAction = filter_input_array(INPUT_POST);
                extract($formAction);
		addProduct( $catListDropDown, $productName, $productDescription, $productImage, $productThumbnail, $productPrice, $productStock, $productSize, $productWeight, $productLocation, $productStyle, $productVendor );
		$message = "<h2 id='message'>Congratulations, ".$productName." was successfully added.</h2>";
            } catch (Exception $prodEx) {
                $message = "<h2 id='message'> Submission Error</h2>";
            }
            break;
        case 'createCategory':
            addCategory( filter_input(INPUT_POST, 'categoryName') );
            header( "Location: /acme/products/index.php" );
            break;
	default:
            include "../view/prod-mgmt.php";
}
////////////////////////////////////////////////////////////////////////////////