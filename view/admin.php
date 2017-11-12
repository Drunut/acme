<?php
    if(!$_SESSION['loggedin']){
        // redirect if they aren't logged in
        header('Location: /acme/');
    }

    if(isset($_SESSION['clientData'])){
        $clientData = $_SESSION['clientData'];
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
                echo "<h1>Welcome, ".$_SESSION['clientData']['clientFirstname']."</h1>";
                if (isset($message)){ echo $message; }
                echo "<ul id='adminUserData'>";
                  
                echo "<li>User Id: ".$_SESSION['clientData']['clientId']."</li>";
                echo "<li>First Name: ".$_SESSION['clientData']['clientFirstname']."</li>";
                echo "<li>Last Name: ".$_SESSION['clientData']['clientLastname']."</li>";
                echo "<li>Email Address: ".$_SESSION['clientData']['clientEmail']."</li>";
                echo "</ul>";
                
                echo "<section id='adminActions'>";
                echo "<a href='/acme/accounts?action=modify'>Update Account Information</a>";
                
                if($_SESSION['clientData']['clientLevel'] > 1){
                    echo "<h2 id='adminModify'>Use the link below to Modify the Products or Categories:</h2>";
                    echo "<p><a href='/acme/products/'>Add new Products or Categories</a></p>";
                }
                echo "</section>";
?>
            
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
