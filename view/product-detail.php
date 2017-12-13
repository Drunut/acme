<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title><?php echo $prodInfo['invName'] ?> Details | Acme, Inc.</title>
        <?php
            include "../common/head.php";
            echo "<style> .nav_li:nth-child(".($prodInfo['categoryId'] + 1)."){ background-color: #ffffff; }  .nav_li:nth-child(".($prodInfo['categoryId'] + 1).") a{ color: #000000; } </style>"; #This keeps the nav properly highlighted
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
                $pageMessage = "<section id='spMessage'>";
                if (isset($_SESSION['message'])){
                    $pageMessage .= $_SESSION['message'];
                    unset($_SESSION['message']);
                } else if(isset($message)){
                    $pageMessage .= $message;
                }
                $pageMessage .= "<p>Reviews can be found at the bottom of the page</p>";
                $pageMessage .= '</section>';
                echo $pageMessage;
                if(isset($prodPage)){ echo $prodPage; }
            ?>
            
            
        </main>

        <footer>
            <?php include "../common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
