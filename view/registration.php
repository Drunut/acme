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
			<?php
                // Checking to see if $message is already set before we do this.
                if (isset($message)) {
                 echo $message;
                }
            ?>
            <form action="/acme/accounts/index.php" id="registrationForm" method="post">
                
                <label for="firstName">First name*</label>
                <input type="text" id="firstName" name="firstName">
                <label for="lastName">Last name*</label>
                <input type="text" id="lastName" name="lastName">
                
                <label for="email">Email Address*</label>
                <input type="email" id='email' name="email">
                <label for="password">Password*</label>
                <p id="passwordReq">8-16 characters in length, at least one upper and lower case letter.</p>
                <input type="password" class="pwdbtn" name="password" pattern="[\w]{8,16}" >
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
