<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title><?php echo $type; ?> Products | Acme, Inc.</title>
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
            <h1><?php echo $type; ?> Products</h1>
            <?php if(isset($message)){ echo $message; } ?>
            <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
