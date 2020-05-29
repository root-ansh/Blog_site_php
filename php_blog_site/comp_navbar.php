
<!--

WARNINGS :
1. THE PAGE TRYING TO LOAD THIS MUST COMPONENT MUST HAVE THE FOLLOWING ITEMS IN THEIR <HEAD> TAG :
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bulma@0.8.1/css/bulma.min.css'>



    <title>My CMS!</title>
</head>


2. SINCE THIS CODE WOULD ACTUALLY BE COPIED INTO EVERY PAGE AUTOMATICALLY, Be careful with the urls. you might think calling them
 with ../filename.php would be a good choice, but instead, you should be directly calling 'filename.php'
-->

<?php

print
    "
<nav class='navbar is-fixed-top is-black' role='navigation' aria-label='main navigation'>

    <section class='navbar-brand'>
        <!-- Homepage-->
        <span class='navbar-item  has-background-warning'>
            <a class='title  has-text-black has-text-weight-bold' href='index.php'> Curioustools</a>
        </span>

        <!-- Hamburger. menu -->
        <a role='button' class='navbar-burger burger' aria-label='menu' aria-expanded='false'
           data-target='navbarBasicExample'>
            <span aria-hidden='true'></span>
            <span aria-hidden='true'></span>
            <span aria-hidden='true'></span>
        </a>

    </section>

    <section class='navbar-menu '>

        <div class='navbar-start'>
            <a class='navbar-item has-text-weight-bold' href='index.php'>Blogs</a>
            <a class='navbar-item has-text-weight-bold' href='p404.php'>Resources</a>
            <a class='navbar-item has-text-weight-bold' href='p404.php'>People</a>
            <a class='navbar-item has-text-weight-bold' href='p404.php'>Admin</a>
        </div>

        <div class='navbar-end'>
            <a href='p404.php' class='navbar-item'>
                <img src='img/logo.svg' height='64' width='64'>
            </a>

            <span class='navbar-item '>
                <a class='navbar-item button is-black is-inverted' href='login_signup.php'>Login/Sign up</a>

            </span>
        </div>
    </section>
</nav>


<script src='https://code.jquery.com/jquery-3.4.1.min.js'
        integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
        crossorigin='anonymous'></script>

<script>
    $(document).ready(function () {

        // Check for click events on the navbar burger icon
        $('.navbar-burger').click(function () {

            // Toggle the 'is-active' class on both the 'navbar-burger' and the 'navbar-menu'
            $('.navbar-burger').toggleClass('is-active');
            $('.navbar-menu').toggleClass('is-active');
        });
    });

</script>



";

?>