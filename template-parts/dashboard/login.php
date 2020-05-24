<section class="login">
    <h2>LOGIN</h2>

    <div class="container">
        <div class="col-md-4">
            <?php
            echo do_shortcode('[mb_user_profile_login label_submit="Login" label_remember="Remember" label_lost_password="Lost Your Password?" confirmation="You are now logged in."]');
            ?>
        </div>

        <p class="notice">Don't have an account ?</p>

        <a class="register" href="<?php echo home_url( '/register' ) ?>">REGISTER</a>
    </div>
</section>