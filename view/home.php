<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="UTF-8">
        <title>ACM - Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/normalize.css"/>
        <link rel = "stylesheet" type = "text/css" href = "/acme/css/small.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/medium.css"/>
        <link rel = "stylesheet" type = "text/css" href ="/acme/css/large.css"/> 

    </head>
    <body>
        <header class="top-layer">

            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/header.php"; ?>

            <nav>
                <?php echo $navList; ?>     
            </nav>
        </header>
        <main class="top-layer">
            <section class="banner">
                <img class="rocket" src="images/site/rocketfeature.jpg" alt="Roadrunner on a Rocket">
                <ul class="rocket_ad">
                    <li><h2>Acme Rocket</h2></li>
                    <li>Quick lighting fuse</li>
                    <li>NHTSA approved seat belts</li>
                    <li>Mobile launch stand included</li>
                    <li><a href="/acme/products/index.php?action=product"><img id="actionbtn" alt="Add to cart button" src="images/site/iwantit.gif"></a></li>
                </ul>         
            </section>
            <section class="recipies_reviews">
                <section class="reviews">
                    <h3>Acme Rocket Reviews</h3>
                    <ul class="reviews">
                        <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                        <li>"That thing was fast!" (4/5)</li>
                        <li>"Talk about fast delivery." (5/5)</li>
                        <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
                        <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
                    </ul>
                </section>

                <section class="recipes">
                    <h3>Featured Recpies</h3>
                    <div class="recipeGallery">
                        <figure  class="gallery">
                            <img  src="images/recipes/bbqsand.jpg" alt="Pulled BBQ Sandwich">
                            <figcaption><a href="https://www.tasteofhome.com/recipes/bbq-beef-sandwiches/" title="BBQ Sandwich Recipe"> Pulled Roadrunner BBQ</a></figcaption>
                        </figure>

                        <figure  class="gallery">
                            <img src="images/recipes/potpie.jpg" alt="Pot Pie">
                            <figcaption><a href="#/" title="Pot Pie Recipe">Roadrunner Pot Pie</a></figcaption>
                        </figure>

                        <figure  class="gallery">
                            <img src="images/recipes/soup.jpg" alt="Soup">
                            <figcaption><a href="#/" title="Soup Recipe">Roadrunner Soup</a></figcaption>
                        </figure>

                        <figure  class="gallery">
                            <img src="images/recipes/taco.jpg" alt="Taco">
                            <figcaption><a href="#/" title="Taco Recipe">Roadrunner Tacos</a></figcaption>
                        </figure>
                    </div>                              
                </section>   
            </section>   
        </main>
        <footer class="top-layer">
            <hr>
            <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/acme/common/footer.php"; ?>       
        </footer>

        <script src="../js/hamburger.js"></script>
        <script src="../js/mainmenu.js"></script>


    </body>
</html>