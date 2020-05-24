<?php
/**
 * Template name: Home
 */
get_header();
?>

<section class="products">
    <div class="products-slider">
        <?php
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => 8
        ];

        $products = new WP_Query($args);

        if ( $products->have_posts() ) :
            while ( $products->have_posts() ) :
                $products->the_post();
        ?>
            <div class="item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'thumb-385' ); ?>

                    <h2><?php the_title(); ?></h2>
                </a>
            </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
    <div class="link-to-shop">
        <a href="<?php echo home_url( '/shop' ) ?>" class="btn bg-yl ttu fw-300 smooth">VIEW MORE</a>
    </div>
</section>

<?php
get_footer();