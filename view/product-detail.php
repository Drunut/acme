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
          
          
          -->
        <main>
            <?php if(isset($message)){ echo $message; } ?>
            <section>
                <img>
            </section>
            <section>
                <h1>$product['invName']</h1> 
                
            </section>
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
