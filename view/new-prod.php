<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Acme</title>
        <?php include "../common/head.php" ?>
    </head>

    <body>
      <div id="floatFrame">
        <header>
            <img id="logo" src="../images/site/logo.gif" alt="Acme Inc. Logo">
            <div id="headerAccountDiv">
                <img id="myAccountImg" src="../images/site/account.gif" alt="My Account">
                <p>My Account</p>
            </div>
            <nav>
                <?php
                    // include "common/nav.php"
                    echo $navList;
                ?>
            </nav>
        </header>

        <main class="indexMain">
            <h1>New Product</h1>
            <?php // Checking to see if $message is already set before we do this.
                    if (isset($prodSuccess)){ echo $prodSuccess; }
                ?>
            <p>Add a new Product below. All fields are required!</p>
            <form action="/acme/products/index.php" id="productForm" method="post">
                
                <label for="catListDropDown">Category</label>
                <?php echo $catList; ?>
                <label for="productName">Product Name</label>
                <input type="text" id="productName" name="productName" required>
                
                <label for="productDescription">Product Description</label>
                <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
                
                <label for="productImage">Product Image (path to image)</label>
                <input type="text" id="productImage" name="productImage" required>
                
                <label for="productThumbnail">Product Thumbnail (path to image)</label>
                <input type="text" id="productThumbnail" name="productThumbnail" required>
                
                <label for="productPrice">Product Price</label>
                <input type="number" id="productPrice" name="productPrice" required>
                
                <label for="productStock">Amount in Stock</label>
                <input type="number" id="productStock" name="productStock" required>
                
                <label for="productSize">Product Size</label>
                <input type="number" id="productSize" name="productSize" required>
                
                <label for="productWeight">Product Weight</label>
                <input type="number" id="productWeight" name="productWeight" required>
                
                <label for="productLocation">Product Location</label>
                <input type="text" id="productLocation" name="productLocation" required>
                
                <label for="productStyle">Product Style</label>
                <input type="text" id="productStyle" name="productStyle" required>
                
                <label for="productVendor">Product Vendor</label>
                <input type="text" id="productVendor" name="productVendor" required>
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
