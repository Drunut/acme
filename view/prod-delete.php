<?php
    if(!isset($_SESSION['loggedin']) && !($clientData['clientLevel'] > 1)){
        header('Location: /acme/index.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>
            <?php
                if( isset($prodInfo['invName']) ){
                    echo "Delete $prodInfo[invName] ";
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
                    echo "Delete $prodInfo[invName] ";
                }
                ?>
            </h1>
            <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
                ?>
            <p>Confirm Product Deletion. The delete is permanent.</p>
            <form action="/acme/products/index.php" id="invForm" method="post">
                
                <label for="invName">Product Name</label>
                <!-- Added the NOT isset so that, if the outcome is successful, it won't re-populate the fields -->
                <input type="text" id="invName" name="invName" readonly
                    <?php
                        if( isset($prodInfo['invName']) ){
                            echo "value=\"".$prodInfo['invName']."\"";
                        }
                    ?>
                >
                
                <label for="invDescription">Product Description</label>
                <textarea id="invDescription" name="invDescription" rows="4" readonly><?php
                        if( isset($prodInfo['invDescription']) ){
                            echo $prodInfo['invDescription'];
                        }
                    ?></textarea>
                
                
                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
                
                <input type="submit" value="Delete Product">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
