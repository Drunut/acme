<?php

/* 
 * The Reviews Controller
 */

// Create or access a Session
session_start();

// Get the database connection file, the acme Model (for the getCategories() function), and the products Model
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php'; //Model for reviews
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
        //Add a new Review
	case 'addReview':
            //Form passes reviewField, clientId, InvId
            include "../view/_______.php";
            break;
        //Deliver a view to edit a review
	case 'editReview':
            include "../view/________.php";
            break;
        //Handle the Review update
        case 'updateReview':
            include "../view/________.php";
            break;
        //Deliver view to confirm deletion
        case 'confirmReviewDelete':
            include '../view/rev-delete-confirm.php';
            break;
        //Handle Review deletion
        case 'deleteReview':
            break;
        //Deliver admin view if logged in, acme home if not
        default:
            if ($_SESSION['loggedin']){
                include "../view/admin.php";
            } else {
                header('Location: /acme/');
            }
}