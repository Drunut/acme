<?php 
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    
    
    
    
    
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Image Management | Acme, Inc.</title>
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
            
            
            <h1>Image Management</h1>
            <p>Welcome to the image Management Page! Please select an option below.</p>
            
            <section id="newProductImage">
                <h2>Add New Product Image</h2>
                <?php if (isset($message)) { echo $message; } ?>
                <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
                    <label for="invItem">Product</label><br>
                    <?php echo $prodSelect; ?><br><br>
                    <label>Upload Image:</label><br>
                    <input type="file" name="file1"><br>
                    <input type="submit" class="regbtn" value="Upload">

                    <input type="hidden" name="action" value="upload">
                </form>
            </section>
            
            <hr>
            
            <section id="existingProductImage">
                <h2>Existing Images</h2>
                <p class="message">If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php if (isset($imageDisplay)) { echo $imageDisplay; } ?>
            </section>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
<?php unset($_SESSION['message']); ?>