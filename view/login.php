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
            <?php echo $headerAccount ?>
            <nav>
                <?php
                    // include "common/nav.php"
                    echo $navList;
                ?>
            </nav>
        </header>

        <main id="loginMain">
            <h1>Acme Login</h1>
            <form action="action.php" id="loginForm" method="post">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email">
                
                <label for="password">Password</label>
                <p id="passwordReq">8-16 characters in length, at least one upper and lower case letter.</p>
                <input type="password" class="pwdbtn" name="password" pattern="[\w]{8,16}" >
                <p>* Required Fields</p>
                <input type="submit" value="Submit">
            </form>
            <h2>Not a Member?</h2>
            <a href="/acme/accounts/index.php?action=registration" id="createAccount">Create an Account</a>
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
