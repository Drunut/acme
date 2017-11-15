<?php

function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $clientPassword);
}

function createNav($categories){
    // Build a navigation bar using the categories we were passed
    $navList = '<ul id="nav_ul">';
    $navList .= "<li class='nav_li'><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    
    foreach ($categories as $category) {
        $navList .= "<li class='nav_li'><a href='/acme/products/?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    
    $navList .= '</ul>';
    return $navList;
}

function createHeaderAccount($loggedin){
    if ($loggedin){
        $headerAccount  = "<a id='headerAccount' href='/acme/accounts/index.php?action=logout'>";
        $headerAccount .= "<img id='myAccountImg' src='/acme/images/site/account.gif' alt='My Account'>";
        $headerAccount  .= "<p>Log Out</p></a>";
    } else {
        $headerAccount  = "<a id='headerAccount' href='/acme/accounts/index.php?action=login'>";
        $headerAccount .= "<img id='myAccountImg' src='/acme/images/site/account.gif' alt='My Account'>";
        $headerAccount  .= "<p>My Account</p></a>";
    }
    
    return $headerAccount;
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= '<hr>';
        $pd .= "<h2>$product[invName]</h2>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}