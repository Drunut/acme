<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Error | Acme, Inc.</title>
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
                <?php include "../common/nav.php" ?>
            </nav>
        </header>

        <main>
            <h1>The Server experienced an Error</h1>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
