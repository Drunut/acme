<?php
    if(!isset($_SESSION['loggedin']) && !($clientData['clientLevel'] > 1)){
        header('Location: /acme/index.php');
    }
    
    // Build a dropdown of categories for prod-update.php
    $catList = '<select id="catListDropDown" name="catListDropDown" form="productForm">';
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        // Repopulate drop-down if it was selected previously or if it was fetched in order to modify
        if (isset($catListDropDown) && ($category['categoryId'] == $catListDropDown) ) {
            $catList .= " selected";
        } elseif( isset($prodInfo['categoryId']) && ($category['categoryId'] === $prodInfo['categoryId']) ){
             $catList .= ' selected ';
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>
            <?php
                if( isset($prodInfo['invName']) ){
                    echo "Modify $prodInfo[invName] ";
                } elseif( isset($invName) ) {
                    echo $invName;
                }
            ?> | Acme, Inc
        </title>
        <?php include "../common/head.php" ?>
    </head>

    <body>
      <div id="floatFrame">
        <header>
            <img id="logo" src="../images/site/logo.gif" alt="Acme Inc. Logo">
            <?php
                  echo $headerAccount
            ?>
            <nav>
                <?php
                    // include "common/nav.php"
                    echo $navList;
                ?>
            </nav>
        </header>

        <main class="indexMain">
            <h1>
                <?php 
                if( isset($prodInfo['invName']) ){ 
                    echo "Modify $prodInfo[invName] ";
                } elseif( isset($invName) ) { 
                    echo $invName; 
                }
                ?>
            </h1>
            <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
                ?>
            <p>Modify the Product below. All fields are required!</p>
            <form action="/acme/products/index.php" id="invForm" method="post">
                
                <label for="catListDropDown">Category</label>
                <?php echo $catList; ?>
                <label for="invName">Product Name</label>
                <!-- Added the NOT isset so that, if the outcome is successful, it won't re-populate the fields -->
                <input type="text" id="invName" name="invName" required
                    <?php
                        if( isset($invName) ){
                            echo "value='$invName'";
                        } elseif( isset($prodInfo['invName']) ) {
                            echo "value='$prodInfo[invName]'";
                        }
                    ?>
                >
                
                <label for="invDescription">Product Description</label>
                <textarea id="invDescription" name="invDescription" rows="4" required><?php
                        if( isset($invDescription) ){
                            echo $invDescription;
                        } elseif( isset($prodInfo['invDescription']) ) {
                            echo $prodInfo['invDescription'];
                        }
                    ?></textarea>
                
                <label for="invImage">Product Image (path to image)</label>
                <input type="text" id="invImage" name="invImage" required 
                    <?php
                        if( isset($invImage) ){
                            echo "value='$invImage'";
                        } elseif( isset($prodInfo['invImage']) ) {
                            echo "value='$prodInfo[invImage]'";
                        }
                    ?>
                >
                
                <label for="invThumbnail">Product Thumbnail (path to image)</label>
                <input type="text" id="invThumbnail" name="invThumbnail" required  
                    <?php
                        if( isset($invThumbnail) ){
                            echo "value='$invThumbnail'";
                        } elseif( isset($prodInfo['invThumbnail']) ) {
                            echo "value='$prodInfo[invThumbnail]'";
                        }
                    ?>
                >
                
                <label for="invPrice">Product Price</label>
                <input type="number" id="invPrice" name="invPrice" required 
                    <?php
                        if( isset($invPrice) ){
                            echo "value='$invPrice'";
                        } elseif( isset($prodInfo['invPrice']) ) {
                            echo "value='$prodInfo[invPrice]'";
                        }
                    ?>
                >
                
                <label for="invStock">Amount in Stock</label>
                <input type="number" id="invStock" name="invStock" required 
                    <?php
                        if( isset($invStock) ){
                            echo "value='$invStock'";
                        } elseif( isset($prodInfo['invStock']) ) {
                            echo "value='$prodInfo[invStock]'";
                        }
                    ?>
                >
                
                <label for="invSize">Product Size</label>
                <input type="number" id="invSize" name="invSize" required 
                    <?php
                        if( isset($invSize) ){
                            echo "value='$invSize'";
                        } elseif( isset($prodInfo['invSize']) ) {
                            echo "value='$prodInfo[invSize]'";
                        }
                    ?>
                >
                
                <label for="invWeight">Product Weight</label>
                <input type="number" id="invWeight" name="invWeight" required 
                    <?php
                        if( isset($invWeight) ){
                            echo "value='$invWeight'";
                        } elseif( isset($prodInfo['invWeight']) ) {
                            echo "value='$prodInfo[invWeight]'";
                        }
                    ?>
                >
                
                <label for="invLocation">Product Location</label>
                <input type="text" id="invLocation" name="invLocation" required 
                    <?php
                        if( isset($invLocation) ){
                            echo "value='$invLocation'";
                        } elseif( isset($prodInfo['invLocation']) ) {
                            echo "value='$prodInfo[invLocation]'";
                        }
                    ?>
                >
                
                <label for="invStyle">Product Style</label>
                <input type="text" id="invStyle" name="invStyle" required 
                    <?php
                        if( isset($invStyle) ){
                            echo "value='$invStyle'";
                        } elseif( isset($prodInfo['invStyle']) ) {
                            echo "value='$prodInfo[invStyle]'";
                        }
                    ?>
                >
                
                <label for="invVendor">Product Vendor</label>
                <input type="text" id="invVendor" name="invVendor" required 
                    <?php
                        if( isset($invVendor) ){
                            echo "value='$invVendor'";
                        } elseif( isset($prodInfo['invVendor']) ) {
                            echo "value='$prodInfo[invVendor]'";
                        }
                    ?>
                >
                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
                
                <input type="submit" value="Update Product">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
