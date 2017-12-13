<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Update Review</title>
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
            <?php // Checking to see if $message adn $rud are already set before we do this.
                    if (isset($_SESSION['message'])){ echo $_SESSION['message']; unset($_SESSION['message']);}
                    if (isset($rud)){ echo $rud; }
            ?>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
