<?php
    if(!isset($_SESSION['loggedin']) && !($clientData['clientLevel'] > 1)){
        header('Location: /acme/index.php');
    }
    // Build a dropdown of categories for new-prod.php
    $catList = '<select id="catListDropDown" name="catListDropDown" form="productForm">';
    foreach ($categories as $category) {
        $catList .= "<option value='$category[categoryId]'";
        // Repopulate drop-down if it was selected previously
        if (isset($catListDropDown) && ($category['categoryId'] == $catListDropDown) ) {
            $catList .= " selected";
        }
        $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>New Product | Acme, Inc.</title>
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

        <main>
            <h1>New Product</h1>
            <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
                ?>
            <p>Add a new Product below. All fields are required!</p>
            <form action="/acme/products/index.php" id="productForm" method="post">
                
                <label for="catListDropDown">Category</label>
                <?php echo $catList; ?>
                <label for="productName">Product Name</label>
                <!-- Added the NOT isset so that, if the outcome is successful, it won't re-populate the fields -->
                <input type="text" id="productName" name="productName" required <?php if(isset($productName) && !isset($prodOutcome)){echo "value='$productName'";} ?> >
                
                <label for="productDescription">Product Description</label>
                <textarea id="productDescription" name="productDescription" rows="4" required><?php if(isset($productDescription) && !isset($prodOutcome)){echo $productDescription;} ?></textarea>
                
                <label for="productImage">Product Image (path to image)</label>
                <input type="text" id="productImage" name="productImage" required <?php if(isset($productImage) && !isset($prodOutcome)){echo "value='$productImage'";} ?> >
                
                <label for="productThumbnail">Product Thumbnail (path to image)</label>
                <input type="text" id="productThumbnail" name="productThumbnail" required <?php if(isset($productThumbnail) && !isset($prodOutcome)){echo "value='$productThumbnail'";} ?> >
                
                <label for="productPrice">Product Price</label>
                <input type="number" id="productPrice" name="productPrice" required <?php if(isset($productPrice) && !isset($prodOutcome)){echo "value='$productPrice'";} ?> >
                
                <label for="productStock">Amount in Stock</label>
                <input type="number" id="productStock" name="productStock" required <?php if(isset($productStock) && !isset($prodOutcome)){echo "value='$productStock'";} ?> >
                
                <label for="productSize">Product Size</label>
                <input type="number" id="productSize" name="productSize" required <?php if(isset($productSize) && !isset($prodOutcome)){echo "value='$productSize'";} ?> >
                
                <label for="productWeight">Product Weight</label>
                <input type="number" id="productWeight" name="productWeight" required <?php if(isset($productWeight) && !isset($prodOutcome)){echo "value='$productWeight'";} ?> >
                
                <label for="productLocation">Product Location</label>
                <input type="text" id="productLocation" name="productLocation" required <?php if(isset($productLocation) && !isset($prodOutcome)){echo "value='$productLocation'";} ?> >
                
                <label for="productStyle">Product Style</label>
                <input type="text" id="productStyle" name="productStyle" required <?php if(isset($productStyle) && !isset($prodOutcome)){echo "value='$productStyle'";} ?> >
                
                <label for="productVendor">Product Vendor</label>
                <input type="text" id="productVendor" name="productVendor" required <?php if(isset($productVendor) && !isset($prodOutcome)){echo "value='$productVendor'";} ?> >
                <input type="hidden" name="action" value="createProduct">
                
                <input type="submit" value="Submit">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
