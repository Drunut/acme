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
            $reviewText = filter_input(INPUT_POST, 'reviewField', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            
            $addReview = addReview($reviewText, $invId, $clientId);
            if($addReview === 1){
                $_SESSION['message'] = "<h2 class='message'>Review Added</h2>";
                header("Location: /acme/products/?action=prodInfo&prodId=$invId");
            } else {
                $_SESSION['message'] = "<h2 class='message'>Review Addition Failed</h2>";
                header("Location: /acme/products/?action=prodInfo&prodId=$invId");
                exit;
            }
            break;
        //Deliver a view to edit a review
	case 'editReview':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $review = getReview($reviewId);
            
            $username = substr($review['clientFirstname'], 0, 1).$review['clientLastname'];
            $rDate = date('F j Y', strtotime($review['reviewDate']) );
            //rud = review update display
            $rud  ="<h1>Update review of $review[invName] from $rDate</h1>";
            $rud .="<form action='/acme/reviews/index.php' id='reviewForm' method='post'>";
            $rud .="<p>Name: $username</p>";

            $rud .="<label for='reviewField'>Review:</label>";
            $rud .="<textarea id='reviewField' name='reviewField' rows='4' required>$review[reviewText]</textarea>";
            $rud .="<input type='hidden' name='invId' value='$review[invId]'>";
            $rud .="<input type='hidden' name='clientId' value='$review[clientId]'>";
            $rud .="<input type='hidden' name='reviewId' value='$review[reviewId]'>";
            $rud .="<input type='hidden' name='action' value='updateReview'>";

            $rud .="<input type='submit' value='Update'>";
            $rud .="</form>";
            include "../view/review-update.php";
            break;
        //Handle the Review update
        case 'updateReview':
            // Form passes ReviewField, invId, clientId, reviewId
            $reviewText = filter_input(INPUT_POST, 'reviewField', FILTER_SANITIZE_STRING);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            if(empty($reviewText)) {
                    $_SESSION['message'] = "<h2 class='message'>Review update cannot be empty.</h2>";
                    header("Location: /acme/reviews/index.php?action=editReview&reviewId=$reviewId]");
                    exit;
            }
            $updateReview = updateReview($reviewId, $reviewText, $invId, $clientId);
            if($updateReview === 1){
                $_SESSION['message'] = "<h2 class='message'>Review Updated Successfully</h2>";
                header("Location: /acme/accounts/index.php?action=admin");
            } else {
                $_SESSION['message'] = "<h2 class='message'>Review Update Failed</h2>";
                header("Location: /acme/reviews/index.php?action=editReview&reviewId=$reviewId]");
                exit;
            }
            break;
        //Deliver view to confirm deletion
        case 'confirmReviewDelete':
            $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            
            $review = getReview($reviewId);
            
            $username = substr($review['clientFirstname'], 0, 1).$review['clientLastname'];
            $rDate = date('F j Y', strtotime($review['reviewDate']) );
            //rdd = review deletion display
            $rdd  ="<h1>Delete $review[invName] review?<br>This cannot be undone!</h1>";
            $rdd .="<form action='/acme/reviews/index.php' id='reviewForm' method='post'>";
            $rdd .="<p>Name: $username</p>";

            $rdd .="<label for='reviewField'>Review:</label>";
            $rdd .="<textarea id='reviewField' name='reviewField' rows='4' required readonly>$review[reviewText]</textarea>";
            $rdd .="<input type='hidden' name='reviewId' value='$review[reviewId]'>";
            $rdd .="<input type='hidden' name='action' value='deleteReview'>";

            $rdd .="<input type='submit' value='Delete'>";
            $rdd .="</form>";
            
            include '../view/review-delete-confirm.php';
            break;
        //Handle Review deletion
        case 'deleteReview':
            $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
            $deleteReview = deleteReview($reviewId);
            if($deleteReview === 1){
                $_SESSION['message'] = "<h2 class='message'>Review Deleted Successfully</h2>";
                header("Location: /acme/accounts/index.php?action=admin");
            } else {
                $_SESSION['message'] = "<h2 class='message'>Review Deletion Failed</h2>";
                header("Location: /acme/reviews/index.php?action=editReview&reviewId=$reviewId]");
                exit;
            }
            break;
        //Deliver admin view if logged in, acme home if not
        default:
            if ($_SESSION['loggedin']){
                include "../view/admin.php";
            } else {
                header('Location: /acme/');
            }
}