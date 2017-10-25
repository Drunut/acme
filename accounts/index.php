<?php
// Get the database connection file
require_once '../library/connections.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
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

switch ($action) {
	case 'login':
		include "../view/login.php";
		break;
	case 'registration':
		include "../view/registration.php";
		break;
	case 'register':
                // Filter and store the data
                $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
                $clientLastname = filter_input(INPUT_POST, 'clientLastname');
                $clientEmail = filter_input(INPUT_POST, 'clientEmail');
                $clientPassword = filter_input(INPUT_POST, 'clientPassword');
                // Check for missing data
                if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
                    $message = '<p>Please provide information for all empty form fields.</p>';
                    include '../view/registration.php';
                    exit;
                }
                
                $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
                if($regOutcome === 1) {
                    $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
                    include '../view/login.php';
                    exit;
                } else {
                    $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
                    include '../view/registration.php';
                    exit;
                }
                break;
	default:
		include "../view/500.php";
}
