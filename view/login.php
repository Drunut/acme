<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Login | Acme, Inc.</title>
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
                <?php // Putting the message in the form because it's more syntactically significant, but mostly looks better.
                    if (isset($message)){ echo $message; }
                ?>
            <form action="/acme/accounts/index.php" id="loginForm" method="post">
                <label for="clientEmail">Email Address</label>
                <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                
                <label for="clientPassword">Password</label>
                <p id="passwordReq">8+ characters in length, with at least 1 number, 1 capital letter and 1 special character</p>
                <input type="password" class="pwdbtn" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                
                <input type="hidden" name="action" value="submitLogin">
                <input type="submit" value="Login">
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
