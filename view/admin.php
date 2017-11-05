<?php
    if(!$_SESSION['loggedin']){
        // redirect if they aren't logged in
        header('Location: /acme/');
    }




?>
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
            <?php
                  echo createHeaderAccount(true); //Re-running it here, because since we're just including it in the login code we need to re-check whether we're logged in.
            ?>
            <nav>
                <?php
                    // include "common/nav.php"
                    echo $navList;
                ?>
            </nav>
        </header>

        <main class="indexMain">
            <?php
                echo "<h1>Welcome, ".$clientData['clientFirstname'].".</h1>";
                echo "<ul id=adminUserData>";
                  
                echo "<li>User Id: ".$clientData['clientId']."</li>";
                echo "<li>First Name: ".$clientData['clientFirstname']."</li>";
                echo "<li>Last Name: ".$clientData['clientLastname']."</li>";
                echo "<li>Email Address: ".$clientData['clientEmail']."</li>";
                echo "<li>Level: ".$clientData['clientLevel']."</li>";
                echo "</ul>";
                
                if($clientData['clientLevel'] > 1){
                    echo "<p><a href='/acme/products/'>Add new Products or Categories</a></p>";
                }
?>
            
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
