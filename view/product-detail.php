<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Acme</title>
        <?php
            include "../common/head.php";
            echo "<style> .nav_li:nth-child(".($prodInfo['categoryId'] + 1)."){ background-color: #ffffff; } </style>"; #This keeps the nav properly highlighted
        ?>
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
        <main id="spPage">
            <?php
                if(isset($message)){ echo $message; }
                if(isset($prodPage)){ echo $prodPage; }
            ?>
            
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
