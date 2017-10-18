<?php
/* 
 * Products controller
 */

// Get the database connection file, the acme Model (for the getCategories() function), and the products Model
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-mode.php';



////////////////////////////////////////////////////////////////////////////////
// Page Control Logic
switch ($action) {
	case 'newCategory':
		include "../view/new-cat.php";
		break;
	case 'newProduct':
		include "../view/new-prod.php";
		break;
	default:
		include "../view/prod-mgmt.php";
}
////////////////////////////////////////////////////////////////////////////////


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
$catList .= '<select name="catListDropDown">';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
}
$catList .= '</select>';
////////////////////////////////////////////////////////////////////////////////