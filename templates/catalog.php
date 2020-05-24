<?php
/**
 * Template name: Catalog
 */

get_header();
?>

<div class="container">
    <div class="top-control">

        <h2 class="page-title">CATALOG</h2>
    </div>

    <div class="row catalog-list">
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
                <div class="col-md-3">
                    <div class="item">
                        <?php the_post_thumbnail( 'full' ); ?>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php
get_footer();