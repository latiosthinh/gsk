<?php
/**
 * Template name: Dashboard
 */

get_header();

if ( is_user_logged_in() ) {
    get_template_part( 'template-parts/dashboard/account-settings' );
} else {
    get_template_part( 'template-parts/dashboard/login' );
}

get_footer();