<?php 
    if(!isset($_SESSION['loggedin']) && !($clientData['clientLevel'] > 1)){
        header('Location: /acme/index.php');
        exit;
    }
    
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
    
    
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Product Management | Acme, Inc.</title>
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
                    echo $navList;
                ?>
            </nav>
        </header>

        <main  id="pMMain">
            <h1>Product Management</h1>
            <p>Welcome to the product management page. Please choose an option below:</p>
            <ul id="pMList">
                <li><a href="/acme/products/index.php?action=newCategory">Add a new Category</a></li>
                <li><a href="/acme/products/index.php?action=newProduct">Add a new Product</a></li>
            </ul>
            <?php
                if ( isset($message) ) {
                    echo $message;
                } if ( isset($prodList) ) {
                    echo $prodList;
                }
            ?>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
<?php unset($_SESSION['message']); ?>