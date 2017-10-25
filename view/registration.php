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

        <main id="registrationMain">
            <h1>Acme Registration</h1>
            <form action="/acme/accounts/index.php" id="registrationForm" method="post">
                <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
                ?>
                <label for="clientFirstName">First name*</label>
                <input type="text" id="clientFirstName" name="clientFirstName">
                <label for="clientLastName">Last name*</label>
                <input type="text" id="clientLastName" name="clientLastName">
                
                <label for="clientEmail">Email Address*</label>
                <input type="email" id='clientEmail' name="clientEmail">
                <label for="clientPassword">Password*</label>
                <p id="passwordReq">8-16 characters in length, at least one upper and lower case letter.</p>
                <input type="password" class="pwdbtn" name="clientPassword" pattern="[\w]{8,16}" >
				<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
                <p>* Required Fields</p>
                
                <input type="submit" value="Register">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
