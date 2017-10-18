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
            <h1>Template Page</h1>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
