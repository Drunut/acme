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
    $navList .= "<li id='homeNavItem' class='nav_li'><a href='/acme/' title='View the Acme home page'>Home</a></li>";
    
    foreach ($categories as $category) {
        $navList .= "<li id='$category[categoryName]NavItem' class='nav_li'><a href='/acme/products/?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
    }
    
    $navList .= '</ul>';
    return $navList;
}

function createHeaderAccount($loggedin){
    $headerAccount = '';
    if ($loggedin){
        // Check for firstname Cookie and add welcome message if it exists
        if(isset($_COOKIE['firstname'])){
            $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
            $headerAccount .= "<a href='/acme/accounts/index.php?action=admin'>Welcome $cookieFirstname</a>";  };
        $headerAccount .= "<a id='headerAccount' href='/acme/accounts/index.php?action=logout'>";
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
        $pd .= "<li><a href='/acme/products/?action=prodInfo&prodId=$product[invId]'>";
        $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= '<hr>';
        $pd .= "<h2>$product[invName]</h2>";
        $pd .= "<span>$$product[invPrice]</span>";
        $pd .= '</a></li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildSpecificProductDisplay($product, $thumbs, $itemReviews){
    $spd = "<img id='spImage' src='$product[invImage]' alt='$product[invName] Product Image'>";
    
    $spd .=     "<section id='spThumbs'>";
    foreach ($thumbs as $row){
        $spd .= "   <img src='$row[imgPath]' alt='$row[imgName]'>";
    }
    $spd .=     "</section>";
            
    $spd .=     "<h1 id='spName'>$product[invName]</h1>";
    $spd .=     "<section id='spStats'>";
    $spd .=     "    <p id='spVendor'>By: $product[invVendor]</p>";
    $spd .=     "    <div>";
    $spd .=     "        <p id='spStyle'>$product[invStyle]<span>style</span> </p>";
    $spd .=     "        <p id='spWeight'>$product[invWeight] lbs. /<span id='spSize'>$product[invSize] ft<sup>3</sup></span> </p>";
    $spd .=     "    </div>";
    $spd .=     "</section>";
            
    $spd .=     "<section id='spAvailability'>";
    $spd .=     "    <p id='spPrice'>$$product[invPrice]</p>";
    $spd .=     "    <p id='spStock'>$product[invStock] in stock</p>";
    $spd .=     "    <p id='spLocation'>      Ships from:<br>$product[invLocation]</p>";
    $spd .=     "</section>";
            
    // The 'see review at bottom of page' block is on the page itself because it needs to optionally include a message
    if(isset($_SESSION['loggedin'])){
        $headerAccount = createHeaderAccount(true);
    } else {
        $headerAccount = createHeaderAccount(false);
    }
            
    $spd .=     "<section id='spExtended'>";
    $spd .=     "    <p id='spDescription'>$product[invDescription]</p>";
    $spd .=     "    <section id='spReviewSection'>";
    $spd .=     "       <h2>Customer Reviews</h2>";
    if(isset($_SESSION['loggedin'])){
        $spd .= "<sub>Review the $product[invName]:</sub>";
        
        //All the review form stuff
        $clientData = $_SESSION['clientData'];
        $first = $clientData['clientFirstname'];
        $last = $clientData['clientLastname'];
        $username = substr($first, 0, 1).$last;
        echo $product['invId'];
        
        //This form goes to the reviews controller with action=addReview
        //Passes reviewField, clientId, InvId
        $spd .="<form action='/acme/reviews/index.php' id='reviewForm' method='post'>";
        $spd .="<p>Name: $username</p>";

        $spd .="<label for='reviewField'>Review:</label>";
        $spd .="<textarea id='reviewField' name='reviewField' rows='4' required>";
            if( isset($invDescription) ){                   $spd .= $invDescription;
            } elseif( isset($prodInfo['invDescription']) ){ $spd .= $prodInfo['invDescription']; }
        $spd .="</textarea>";
        $spd .="<input type='hidden' name='invId' value='";
            $spd .= $product['invId'];
            $spd .="'>";
        $spd .="<input type='hidden' name='clientId' value='";
            if(isset($clientData['clientId'])){ $spd .= $clientData['clientId'];    }
            $spd .= "'>";
        $spd .="<input type='hidden' name='action' value='addReview'>";

        $spd .="<input type='submit' value='Submit Review'>";
        $spd .="</form>";
        
    } else {
        $spd .= "       <sub><a href='/acme/accounts/index.php?action=login'>Log in</a> to leave a review!</sub>";
    }
    $spd .=     "       <section id='spReviews'>";
    foreach ($itemReviews as $row){
                //Insert the item reviews
                //Reviews are listed most recent first thanks to 'ORDER BY reviewDate DESC' in SQL query
                $rFirst = $row['clientFirstname'];
                $rLast = $row['clientLastname'];
                $rUsername = substr($rFirst, 0, 1).$rLast;
                $rDate = date('j F Y', strtotime($row['reviewDate']) );

                $spd .=     "<article class='spReview'>";
                $spd .=     "   <h3 class='author'>$rUsername</h3>";
                $spd .=     "   <p class='timestamp'>written on $rDate:</p>";
                $spd .=     "   <p class='comment'>$row[reviewText]</p>";
                $spd .=     "</article>";
    }
    $spd .=     "       </section>";
    $spd .=     "    </section>";
                
    $spd .=     "</section>";
    return $spd; 
}


/* * ********************************
* Functions for working with images
* ********************************* */


// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    
    return $id;
}

// Build the products select list
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";
    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }
    $prodList .= '</select>';
    
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
         return;
        }
        
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        
        // Send file for further processing
        processImage($image_dir_path, $filename);
        
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        
        // Returns the path where the file is stored
        return $filepath;
    }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}


// Checks and Resizes image
// UPLOADED IMAGES MUST BE JPG, NOT JPEG
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height){

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;
    
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;
    
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;
    
        default:
            return;
    }

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
     } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
}