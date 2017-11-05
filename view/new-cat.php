<?php 
    if(!isset($_SESSION['loggedin']) && !($clientData['clientLevel'] > 1)){
        header('Location: /acme/index.php');
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
            <h1>New Category</h1>
            <?php // Checking to see if $message is already set before we do this.
                    if (isset($message)){ echo $message; }
            ?>
            <p>Add a new category of products below</p>
            <form action="/acme/products/index.php" id="categoryForm" method="post">
                
                <label for="categoryName">New Category Name</label>
                <input type="text" id="categoryName" name="categoryName" required <?php if(isset($categoryName) && !isset($catOutcome)){echo "value='$catName'";} ?>>
                <input type="hidden" name="action" value="createCategory">
                    
                
                <input type="submit" value="Submit">
                
                
            </form>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
