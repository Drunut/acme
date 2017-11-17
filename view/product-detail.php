<?php 
require_once '../library/connections.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
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

// THIS BLOCK IS ONLY HERE FOR TESTING ^^^^^

?>
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
          
          <!--
          Name, Description, Image, Thumbnail, Price, Stock, Size, Weight, Location, Vendor, Style
          Now for some dummy data
          -->
          <?php 
          $prodInfo = getProductInfo(4);
          
          
          
          ?>
        <main id="spPage">
            <?php if(isset($message)){ echo $message; } ?>
            
            <img id='spImage' src='<?php echo $prodInfo['invImage']?>'>
            
            <section id='spStats'>
                <h1 id='spName'><?php echo $prodInfo['invName']?></h1>
                <p id='spVendor'><?php echo $prodInfo['invVendor']?></p>
                <section id='spAvailability'>
                    <h2 id='spPrice'><?php echo $prodInfo['invPrice']?></h2>
                    <p id='spStock'><?php echo $prodInfo['invStock']?></p>
                    <p id='spLocation'><?php echo $prodInfo['invLocation']?></p>
                </section>
                <p id='spStyle'><?php echo $prodInfo['invStyle']?></p><span> style</span>
                <p id='spWeight'><?php echo $prodInfo['invWeight']?></p>
                <p id='spSize'><?php echo $prodInfo['invSize']?></p>
            </section>
            <section id='spExtended'>
                <p id='spDescription'><?php echo $prodInfo['invDescription']?></p>
            </section>
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
