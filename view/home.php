<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Acme</title>
        <?php include "common/head.php" ?>
    </head>

    <body>
      <div id="floatFrame">
        <header>
            <img id="logo" src="images/site/logo.gif" alt="Acme Inc. Logo">
            <?php if(isset($cookieFirstname)){
                    echo "<span>Welcome $cookieFirstname</span>";
                  };
                  echo $headerAccount //iirc you had us put the header account stuff in the controller too, so it's over in \acme\index.php
            ?>
            <nav>
                <?php
                    // include "common/nav.php"
                    echo $navList;
                ?>
            </nav>
        </header>

        <main class="indexMain">
            <h1>Welcome to Acme!</h1>
            <section id="rocket">
                <img id="rocketImg" src="images/site/rocketfeature.jpg" alt="Rocket Responsibly">
                <ul>
                    <li><h2>Acme Rocket</h2></li>
                    <li>Quick lighting fuse</li>
                    <li>NHTSA approved seat belts</li>
                    <li>Mobile launch stand included</li>
                    <li>
                        <a href="/acme/cart/" title="Add the Acme Rocket to your Cart">
                            <img id="actionbtn" alt="Add to cart button" src="/acme/images/site/iwantit.gif">
                        </a>
                    </li>
                </ul>
            </section>
            <section id="reviews">
               <h2>Acme Rocket Reviews</h2>
                <ul>
                    <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                    <li>"That thing was fast!" (4/5)</li>
                    <li>"Talk about fast delivery." (5/5)</li>
                    <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                    <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                </ul>
            </section>
            <section id="recipes">
               <h2>Featured Recipes</h2>
                <ul>
                    <li>
                        <img src="images/recipes/bbqsand.jpg" alt="BBQ Sandwich">
                        <a href="" title="Pulled Roadrunner BBQ">Pulled Roadrunner BBQ</a>
                    </li>
                    <li>
                        <img src="images/recipes/potpie.jpg" alt="Pot Pie">
                        <a href="" title="Roadrunner Pot Pie">Roadrunner Pot Pie</a>
                    </li>
                    <li>
                        <img src="images/recipes/soup.jpg" alt="Soup">
                        <a href="" title="Roadrunner Soup">Roadrunner Soup</a>
                    </li>
                    <li>
                        <img src="images/recipes/taco.jpg" alt="Tacos">
                        <a href="" title="Roadrunner Tacos">Roadrunner Tacos</a>
                    </li>
                </ul>
            </section>
        </main>

        <footer>
            <?php include "common/footer.php"?>
        </footer>
      </div>
    </body>



</html>
