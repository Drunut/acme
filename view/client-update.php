<?php
    if(!$_SESSION['loggedin']){
        // redirect if they aren't logged in
        header('Location: /acme/');
    }
?><!DOCTYPE html>
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

        <main class="indexMain">
            <h1>Account Update</h1>
                <?php // Checking to see if $message is already set before we do this.
                    if (isset($accMessage)){ echo $accMessage; }
                ?>
            <form action="/acme/accounts/index.php" id="accountUpdate" method="post">
                <label for="clientFirstname">First name</label>
                <input type="text" id="clientFirstname" name="clientFirstname" <?php if(isset($clientData['clientFirstname'])){echo "value=\"".$clientData['clientFirstname']."\"";} ?> required>
                <label for="clientLastname">Last name</label>
                <input type="text" id="clientLastname" name="clientLastname" <?php if(isset($clientData['clientLastname'])){echo "value=\"".$clientData['clientLastname']."\"";} ?> required>
                <label for="clientEmail">Email Address</label>
                <input type="email" id='clientEmail' name="clientEmail" <?php if(isset($clientData['clientEmail'])){echo "value=\"".$clientData['clientEmail']."\"";} ?> required>
				<!-- Add the action name - value pair -->
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">
                <input type="hidden" name="action" value="modifyAccount">
                
                <input type="submit" value="Update Account">
                
                
            </form>
            
            
            
            
            <h1>Password Update</h1>
                <?php // Checking to see if $message is already set before we do this.
                    if (isset($pwMessage)){ echo $pwMessage; }
                ?>
            <form action="/acme/accounts/index.php" id="passwordUpdate" method="post">
            <label for="clientPassword">Change Current Password to:</label>
                <p id="passwordReq">8+ characters in length, with at least 1 number, 1 capital letter and 1 special character</p>
                <input type="password" class="pwdbtn" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">
                <input type="hidden" name="action" value="modifyPassword">
                <input type="submit" value="Update Password">
            </form>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
