<?php
/**
 * Template name: Register
 */

get_header();
?>

<div class="container">
    <div class="row registration">
        <div class="col-md-6">
        <?php
        echo do_shortcode( '[mb_user_profile_register 
            id="meta-box-id" 
            label_submit="Register" 
            confirmation="Your account has been created successfully."]
            ');
        ?>
        </div>
    </div>
</div>


<?php
get_footer();