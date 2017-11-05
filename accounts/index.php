<?php

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
$categories = getCategories();

// Modularized the Header stuff since it was getting used across three controllers
if(isset($_SESSION['loggedin'])){
    $headerAccount = createHeaderAccount(true);
} else {
    $headerAccount = createHeaderAccount(false);
}

// Build a navigation bar using the $categories array
$navList = createNav($categories);


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
        case 'admin':
                include "../view/admin.php";
                break;
	case 'register':
                // Filter and store the data
                $clientFirstname = filter_input(INPUT_POST, 'clientFirstName', FILTER_SANITIZE_STRING);
                $clientLastname = filter_input(INPUT_POST, 'clientLastName', FILTER_SANITIZE_STRING);
                $clientEmail = filter_input(INPUT_POST, 'clientEmail');
                $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
                $clientEmail = checkEmail($clientEmail);
                $checkPassword = checkPassword($clientPassword); // 1/0 == T/F
                // Check if the email is already registered
                if (checkDupe($clientEmail)){
                    $message = "<h2 id='message'>That email address has already been registered. Try Logging in.</h2>";
                    include '../view/login.php';
                    exit;
                }
                
                // Check for missing data
                if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
                    $message = "<h2 id='message'>Please provide information for all empty form fields.</h2>";
                    include '../view/registration.php';
                    exit;
                }
                
                //Hash the password and send registration data to the model
                $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
                $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
                if($regOutcome === 1) {
                    // Set Cookies
                    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
                    $message = "<h2 id='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</h2>";
                    include '../view/login.php';
                    exit;
                } else {
                    $message = "<h2 id='message'>Sorry $clientFirstname, but the registration failed. Please try again.</h2>";
                    include '../view/registration.php';
                    exit;
                }
                break;
        case 'submitLogin':
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientEmail = checkEmail($clientEmail);
            $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
            $checkPassword = checkPassword($clientPassword); // 1/0 == T/F
            if(empty($clientEmail) || empty($checkPassword)) {
                    echo "email[".$clientEmail."]"; echo "PassCheck[".$checkPassword."]";
                    $message = "<h2 id='message'>Please provide information for all empty form fields.</h2>";
                    include '../view/login.php';
                    exit;
                }
            // Continue Login
            // 
            // Query the client data based on the email address
            $clientData = getClient($clientEmail);
            // Compare the password just submitted against
            // the hashed password for the matching client
            $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
              $message = '<p class="notice">Please check your password and try again.</p>';
              include '../view/login.php';
              exit;
            }
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            // Send them to the admin view
            include '../view/admin.php';
            exit;
        case 'logout':
            session_destroy();
            header('Location: /acme/index.php');
	default:
		include "../view/500.php";
}
