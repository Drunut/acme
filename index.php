<?php

// Create or access a Session
session_start();





// Get the database connection file
require_once 'library/connections.php';
// Get the acme model for use as needed
require_once 'model/acme-model.php';
// So we can create our navList
require_once 'library/functions.php';
$categories = getCategories();


$headerAccount  = "<a id='headerAccount' href='/acme/accounts/index.php?action=login'>";
$headerAccount .= "<img id='myAccountImg' src='/acme/images/site/account.gif' alt='My Account'>";
$headerAccount  .= "<p>My Account</p></a>";

// Build a navigation bar using the $categories array
$navList = createNav($categories);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
// Check for Cookie
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}


switch ($action){

    case 'something':

    break;

    default:
        include 'view/home.php';
}
