<!doctype html>
<html class="has-navbar-fixed-top has-background-white-bis" lang="en">
<?php include "comp_head.php" ?>

<body>
<?php include "comp_navbar.php" ?>

<section class="section columns">

    <!--  Login  -->
    <section class="column is-4">

        <!-- Login     -->
        <section class="box is-vcentered">
            <p class="subtitle is-4 has-text-black has-text-weight-bold">Login</p>

            <form action="login_checker.php" method="get">

                <div class="field">

                    <label class="label" for="id_email">Email</label>
                    <p class="control">
                        <input class="input is-warning" type="email" id="id_email"
                               placeholder="Please enter your email:">
                    </p>

                </div>

                <div class="field">

                    <label class="label" for="id_password">Password</label>
                    <p class="control">
                        <input class="input is-warning" type="password" id="id_password"
                               placeholder="Password(8-12 letters)">
                    </p>

                </div>

                <div class="control">
                    <input class="button is-warning is-fullwidth has-text-black has-text-weight-bold" type="submit"
                           value="LOGIN">
                </div>

            </form>


        </section>

    </section>

    <!--    Forgot Password? -->
    <section class="column is-4">

        <!-- search box       -->
        <section class="box ">
            <p class="subtitle is-4 has-text-black has-text-weight-bold">Forgot Password?</p>

            <form action="recover_checker.php">

                <label class="label" for="id_email_rec">Enter your email to get password(if present on our
                    servers)</label>
                <div class="field is-grouped">
                    <span class="control is-expanded">
                        <input class="input is-warning" id="id_email_rec" type="email" placeholder="Your email id">
                    </span>
                    <span class="control">
                        <input class="button is-warning " type="submit" value="RECOVER">
                    </span>

                </div>
            </form>


        </section>




    </section>


    <!--  Sign up  -->
    <section class="column is-4">

        <section class="box is-vcentered">
            <p class="subtitle is-4 has-text-black has-text-weight-bold">New User Registration</p>

            <form action="new_reg.php" method="get">

                <div class="field">

                    <label class="label" for="id_reg_name">Name</label>
                    <p class="control">
                        <input class="input is-warning" type="text" id="id_reg_name"
                               placeholder="UserName">
                    </p>

                </div>

                <div class="field">

                    <label class="label" for="id_reg_email">Email</label>
                    <p class="control">
                        <input class="input is-warning" type="email" id="id_reg_email"
                               placeholder="Please enter your email:">
                    </p>

                </div>

                <div class="field">

                    <label class="label" for="id_reg_pass">Password</label>
                    <p class="control">
                        <input class="input is-warning" type="password" id="id_reg_pass"
                               placeholder="Password(8-12 letters)">
                    </p>

                </div>
                <div class="field">

                    <label class="label" for="id_reg_pass2">Re Enter Password</label>
                    <p class="control">
                        <input class="input is-warning" type="password" id="id_reg_pass2"
                               placeholder="Password(8-12 letters)">
                    </p>

                </div>

                <div class="control">
                    <input class="button is-warning is-fullwidth has-text-black has-text-weight-bold" type="submit"
                           value="REGISTER">
                </div>

            </form>


        </section>

    </section>


</section>




</body>
</html>


