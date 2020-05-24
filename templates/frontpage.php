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
        wp_reset_postdata();
        ?>
    </div>
    <div class="link-to-shop">
        <a href="<?php echo home_url( '/shop' ) ?>" class="btn bg-yl ttu fw-300 smooth">VIEW MORE</a>
    </div>
</section>

<section class="intro">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo IMG . '/first-mask-1.jpg' ?>">

                <h2><span>Carpagon’s Original Idea...</span></h2>
                <p>For a long time, Artkey’s products are always inspired by familiar creatures/things existing around us and kindly put under artistic lens. This time, please let Artkey to tell you a story about Carpagon - a significant feature that closely connects to Vietnamese culture.
                <br>
For a long time, Artkey’s products are always inspired by familiar creatures/things existing around us and kindly put under artistic lens. This time, please let Artkey to tell you a story about Carpagon - a significant feature that closely connects to Vietnamese culture</p>
            </div>

            <div class="col-md-6">
                <h2><span>GSK's very first mark...</span></h2>
                <p>For a long time, Artkey’s products are always inspired by familiar creatures/things existing around us and kindly put under artistic lens. This time, please let Artkey to tell you a story about Carpagon - a significant feature that closely connects to Vietnamese culture.
                <br>
For a long time, Artkey’s products are always inspired by familiar creatures/things existing around us and kindly put under artistic lens. This time, please let Artkey to tell you a story about Carpagon - a significant feature that closely connects to Vietnamese culture</p>

                <img src="<?php echo IMG . '/first-mask-2.jpg' ?>">
            </div>
        </div>
    </div>
</section>

<section class="blog">
    <div class="container">

    <div class="blog-slider">
        <?php
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 4
        ];

        $products = new WP_Query($args);

        if ( $products->have_posts() ) :
            while ( $products->have_posts() ) :
                $products->the_post();
        ?>
            <!-- <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <a href="<?php the_permalink() ?>">
                    <img src="<?php echo the_post_thumbnail_url( 'thumb-315' ) ?>">
                </a>

                <div class="entry-content">
                    <a href="<?php the_permalink() ?>">
                        <h3><?php the_title() ?></h3>
                    
                        <?php the_excerpt() ?>
                    </a>
                    <div class="tags">
                        <?php
                        $tags = get_the_tags( get_the_ID() );
                        foreach ( $tags as $tag )  {
                            echo '<a href="' . get_tag_link( $tag->term_id ) . '">#' .  $tag->name . '</span>';
                        }
                        ?>
                    </div>
                </div>
            </article> -->
        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
    <div class="link-to-shop">
        <!-- <a href="<?php echo home_url( '/shop' ) ?>" class="btn bg-yl ttu fw-300 smooth">VIEW MORE</a> -->
    </div>

    </div>
</section>

<?php
get_footer();