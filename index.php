<?php
// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
$categories = getCategories();


$headerAccount  = "<a id='headerAccount' href='/acme/accounts/index.php?action=login'>";
$headerAccount .= "<img id='myAccountImg' src='/acme/images/site/account.gif' alt='My Account'>";
$headerAccount  .= "<p>My Account</p></a>";

// Build a navigation bar using the $categories array
$navList = '<ul id="nav_ul">';
$navList .= "<li class='nav_li'><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
foreach ($categories as $category) {
$navList .= "<li class='nav_li'><a href='/acme/index.php?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= '</ul>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


switch ($action){

    case 'something':

    break;

    default:
        include 'view/home.php';
}
