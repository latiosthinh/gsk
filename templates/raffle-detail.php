<?php
/**
 * Template name: Raffle detail
 */
get_header();
?>


<?php
    $args = [
        'post_type'  => 'product',
        'meta_query' => [
            [
                'key'   => 'gskon_raffle',
                'value' => '1',
            ],
        ],
    ];

    $raffle = new WP_Query($args);

    if ( $raffle->have_posts() ) :
        while ( $raffle->have_posts() ) : $raffle->the_post();

            get_template_part( 'template-parts/raffle/content-raffle' );

        endwhile;
    endif;
    
    wp_reset_postdata();
?>

<?php
get_footer();