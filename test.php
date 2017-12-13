<?php

/* 
 * This is a test page for Grid stuff.
 */

?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <title>Testing Page | Acme, Inc.</title>
        <meta name="author" content="Nikolaas Tekulve">
        <meta name="Description" content="Acme Website">
        <meta charset="utf-8">
        <link rel="stylesheet" href="/acme/styles/test.css" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
      <div id="floatFrame">
        <header>
            
        </header>
        <main id="spPage">
            <img id="spImage" src="/acme/images/products/rubberband.jpg" alt="Monster Rubber Band Product Image">
            <section id="spThumbs">
                <img src="/acme/images/products/rubberband-tn.jpg" alt="rubberband-tn.jpg">
                <img src="/acme/images/products/sweatPig-tn.jpg" alt="sweatPig-tn.jpg">
                <img src="/acme/images/products/oh_my-tn.jpg" alt="oh_my-tn.jpg">
            </section>
            
            <h1 id="spName">                Monster Rubber Band </h1>
            <section id="spStats">
                <p id="spVendor">               By: Rubbermaid </p>
                <div>
                    <p id="spStyle">                Rubber<span>style</span> </p>
                    <p id="spWeight">               1 lbs. /<span id="spSize" class="spStats">75 ft<sup>3</sup></span> </p>
                </div>
            </section>
            
            <section id="spAvailability">
                <p id="spPrice">         $4.00 </p>
                <p id="spStock">         4589 in stock </p>
                <p id="spLocation">      Ships from:<br>Cedar Point, IO </p>
            </section>
            
            <section id="spMessage">
                <p>Reviews can be found at the bottom of the page</p>
            </section>
            
            <section id="spExtended">
                <p id="spDescription">       These are not tiny rubber bands. These are MONSTERS!
                                                                These bands can stop a train locamotive or be used as a slingshot for cows.
                                                                Only the best materials are used!
                </p>
                <section id="spReviewSection">
                    <h2>Customer Reviews</h2>
                    <sub>Review the Monster Rubber Band</sub>
                    
                        <form action="/acme/reviews/index.php" id="reviewForm" method="post">
                            <?php
                                    // This stuff goes in reviews controller
                                    $clientData = '';       //$_SESSION['clientData'];
                                    $first = 'Nikolaas';    //$clientData['clientFirstName'];
                                    $last = 'Tekulve';      //$clientData['clientLastName'];
                                    $username = substr($first, 0, 1).$last;
                            ?>

                            <p>Name: <?php echo $username; ?></p>

                            <!-- <label for="userName">Username:</label>
                            <input type="text" id="userName" name="userName" required readonly <?php //echo "value='$username'"; ?> > -->

                            <label for="invDescription">Review:</label>
                            <textarea id="invDescription" name="invDescription" rows="4" required><?php
                                    if( isset($invDescription) ){
                                        echo $invDescription;
                                    } elseif( isset($prodInfo['invDescription']) ) {
                                        echo $prodInfo['invDescription'];
                                    }
                                ?></textarea>
                            <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
                            <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">
                            <input type="hidden" name="action" value="addReview">

                            <input type="submit" value="Submit Review">


                        </form>
                    <section id="spReviews">
                        <article class="spReview">
                            <h3 class="author">TSawyer</h3>
                            <p class="timestamp">wrote on 10 March, 2017:</p>
                            <p class="comment">This is wonderful. You can catch an elephant with this thing!</p>
                        </article>
                        <article class="spReview">
                            <h3 class="author">TSawyer</h3>
                            <p class="timestamp">wrote on 10 March, 2017:</p>
                            <p class="comment">This is wonderful. You can catch an elephant with this thing!</p>
                        </article>
                    </section>
                </section>
                
            </section>
            
            
        </main>

        <footer>
            
        </footer>
      </div>
    </body>



</html>
