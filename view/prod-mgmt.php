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
            <div id="headerAccountDiv">
                <img id="myAccountImg" src="../images/site/account.gif" alt="My Account">
                <p>My Account</p>
            </div>
            <nav>
                <?php
                    echo $navList;
                ?>
            </nav>
        </header>

        <main class="indexMain" id="pMMain">
            <h1>Product Management</h1>
            <p>Welcome to the product management page. Please choose an option below:</p>
            <ul id="pMList">
                <li><a href="/acme/products/index.php?action=newCategory">Add a new Category</a></li>
                <li><a href="/acme/products/index.php?action=newProduct">Add a new Product</a></li>
            </ul>
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
