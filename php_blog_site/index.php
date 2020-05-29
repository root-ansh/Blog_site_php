<!doctype html>
<html class="has-navbar-fixed-top has-background-white-bis" lang="en">
<?php include "comp_head.php" ?>

<body >
<?php include "comp_navbar.php" ?>


<section class="columns" style="margin: 16px">

    <section class="column is-8" id="blog_area">


        <?php

        function getArticle($details)
        {

            $article_html =
                "
                    <article class='box' id='output_area'>
                <a href='article_details.php' >
            
                    <!-- head Section  : title              -->
                    <p id='blog_title' class='title is-1 has-text-weight-bold' style='color: black'>
                        This is a title
                    </p>
                    <hr>
            
                    <!-- Body Section title,date,author,authorlinks-->
                    <section class='columns' style='padding: 1%'>
            
                        <section
                                class='column is-3 is-vcentered box is-shadowless has-background-warning has-text-centered'>
                            <p class='subtitle has-text-black has-text-weight-bold'>Ansh Sachdeva</p>
                            <p class='subtitle is-6 has-text-weight-bold has-text-grey-darker'>July 21,2020 @ 4.30 pm</p>
                            <hr>
            
                            <a href='https://www.google.com'><img src='img/email.png' height='48' width='48'
                                                                  alt='email'></a>
                            <a href='https://www.google.com'><img src='img/fb.png' height='48' width='48' alt='email'></a>
                            <a href='https://www.google.com'><img src='img/github.png' height='48' width='48'
                                                                  alt='email'></a>
                            <a href='https://www.google.com'><img src='img/linkedin.png' height='48' width='48' alt='email'></a>
                            <a href='https://www.google.com'><img src='img/medium.png' height='48' width='48'
                                                                  alt='email'></a>
                            <a href='https://www.google.com'><img src='img/twitter.png' height='48' width='48' alt='email'></a>
                        </section>
                        <section class='column is-vcentered'>
                            <p class='subtitle is-4  has-text-grey-light'>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis error fugiat illo iste
                                minus, necessitatibus quod sed ullam veniam voluptates? Cumque earum minima repudiandae.
                                Culpa eius magnam molestiae natus
                                <a class='has-text-black' href='article_details.php'>...Read More</a>
            
                            </p>
                            <!-- Footer Section : -->
                            <div class='buttons '>
                                <a href='https://github.com' class='button is-medium is-warning is-light '> Android</a>
                                <a href='https://github.com' class='button is-medium is-warning is-light '> Android</a>
                                <a href='https://github.com' class='button is-medium is-warning is-light '> Android</a>
            
                            </div>
            
            
                        </section>
            
                    </section>
                </a>
            
            </article>
                ";
            return $article_html;

        }

        for ($x = 0; $x < 10; $x++) {
            print getArticle($x);
        }

        ?>

    </section>

    <aside class="column">

        <!-- search box       -->
        <section class="box is-shadowless">
            <p class="subtitle is-4 has-text-black has-text-weight-bold">Search</p>
            <form action="evaluatorPage.php">
                <p class="field is-grouped">
                    <span class="control is-expanded">
                        <input class="input is-warning" id="fname" type="text" placeholder="Search By Tags,Authors or Content!">
                    </span>
                    <span class="control">
                        <input class="button is-warning " type="submit" value="Search">
                    </span>
                </p>

            </form>
            <br>

            <p class="subtitle is-7 has-text-black has-text-weight-bold">Available Tags :</p>

            <p class="buttons">
                <a href='https://github.com' class='button is-light '> Android</a>
                <a href='https://github.com' class='button   is-light '> ML</a>
                <a href='https://github.com' class='button   is-light '> Web</a>
                <a href='https://github.com' class='button is-light '> Android</a>
                <a href='https://github.com' class='button   is-light '> ML</a>
                <a href='https://github.com' class='button   is-light '> Web</a>
                <a href='https://github.com' class='button is-light '> Android</a>
                <a href='https://github.com' class='button   is-light '> ML</a>
                <a href='https://github.com' class='button   is-light '> Web</a>
                <a href='https://github.com' class='button is-light '> Android</a>
                <a href='https://github.com' class='button   is-light '> ML</a>
                <a href='https://github.com' class='button   is-light '> Web</a>
            </p>


        </section>

        <!-- recent articles  box  -->
        <section class="box is-shadowless">
            <p class="subtitle is-4 has-text-black has-text-weight-bold">Recent Articles</p>

            <a href="article_details.php">
                <article class="box columns">
                    <div class="column is-2">
                        <img src="img/logo.svg" width="64" height="64">
                    </div>
                    <div class="column">
                        <p class="has-text-black has-text-weight-bold">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                        <p>
                            <span class="has-text-grey-dark subtitle is-6">Ansh Sachdeva</span>  |
                            <span class="has-text-grey subtitle is-6">July 20,2020</span>
                        </p>
                    </div>
                </article>
            </a>
            <br><br>



            <a href="article_details.php">
                <article class="box columns">
                    <div class="column is-2">
                        <img src="img/logo.svg" width="64" height="64">
                    </div>
                    <div class="column">
                        <p class="has-text-black has-text-weight-bold">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                        <p>
                            <span class="has-text-grey-dark subtitle is-6">Ansh Sachdeva</span>  |
                            <span class="has-text-grey subtitle is-6">July 20,2020</span>
                        </p>
                    </div>
                </article>
            </a>
            <br><br>



            <a href="article_details.php">
                <article class="box columns">
                    <div class="column is-2">
                        <img src="img/logo.svg" width="64" height="64">
                    </div>
                    <div class="column">
                        <p class="has-text-black has-text-weight-bold">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                        <p>
                            <span class="has-text-grey-dark subtitle is-6">Ansh Sachdeva</span>  |
                            <span class="has-text-grey subtitle is-6">July 20,2020</span>
                        </p>
                    </div>
                </article>
            </a>
            <br><br>

            <a href="article_details.php">
                <article class="box columns">
                    <div class="column is-2">
                        <img src="img/logo.svg" width="64" height="64">
                    </div>
                    <div class="column">
                        <p class="has-text-black has-text-weight-bold">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                        <p>
                            <span class="has-text-grey-dark subtitle is-6">Ansh Sachdeva</span>  |
                            <span class="has-text-grey subtitle is-6">July 20,2020</span>
                        </p>
                    </div>
                </article>
            </a>
            <br><br>






        </section>


    </aside>

</section>


</body>
</html>