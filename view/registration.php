<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Registration | Acme, Inc.</title>
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
                <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
                ?>
            <form action="/acme/accounts/index.php" id="registrationForm" method="post">
                <label for="clientFirstname">First name*</label>
                <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?> required>
                <label for="clientLastname">Last name*</label>
                <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
                
                <label for="clientEmail">Email Address*</label>
                <input type="email" id='clientEmail' name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
                <label for="clientPassword">Password*</label>
                <p id="passwordReq">8+ characters in length, with at least 1 number, 1 capital letter and 1 special character</p>
                <input type="password" class="pwdbtn" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
				<!-- Add the action name - value pair -->
                    <input type="hidden" name="action" value="register">
                <p>* All Fields Required</p>
                
                <input type="submit" value="Register">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
