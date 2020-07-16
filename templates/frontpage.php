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
			<?php
			$args = [
				'post_type'      => 'post',
				'posts_per_page' => 2
			];

			$b = new WP_Query($args);
			$i = 0;
			if ( $b->have_posts() ) :
				while ( $b->have_posts() ) :
					$b->the_post();
					$i++;
			?>

			<div class="col-md-6">
				<?php if ( $i % 2 != 0 ) : ?>
					<img src="<?php the_post_thumbnail_url('thumb-500') ?>">

					<h2><span><?php the_title(); ?></span></h2>
					<?php the_excerpt(); ?>
				<?php else :  ?>
					<h2><span><?php the_title(); ?></span></h2>
					<?php the_excerpt(); ?>

					<img src="<?php the_post_thumbnail_url('thumb-500') ?>">
				<?php endif;  ?>
			</div>

			<?php
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<section class="blog">
	<div class="container">

	<div class="blog-slider">
		<?php
		$args = [
			'post_type'      => 'post',
			'offset'         => 2,
			'posts_per_page' => 8
		];

		$products = new WP_Query($args);

		if ( $products->have_posts() ) :
			while ( $products->have_posts() ) :
				$products->the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
							echo '<a href="' . get_tag_link( $tag->term_id ) . '">#' .  $tag->name . '</a>';
						}
						?>
					</div>
				</div>
			</article>
		<?php
			endwhile;
		endif;
		wp_reset_postdata();
		?>
	</div>
	<div class="link-to-shop">
		<a href="<?= home_url( '/story' ) ?>" class="btn bg-yl ttu fw-300 smooth">VIEW MORE</a>
	</div>

	</div>
</section>

<section class="home-about">
	<div class="container-fluid">
		<div class="row">
			<div class="container home-about__content">
				<div class="row">
					<div class="col-md-6">
						<?php $page_about = get_page_by_path( 'about-us' ); ?>
						<?= $page_about->post_content; ?>

						<div class="logo">
							<img src="<?= IMG . '/logo-gold.png' ?>" alt="gsk">
							<h2>GSK</h2>
						</div>

						<a href="<?= get_permalink( $page_about->ID ) ?>" class="btn bg-yl ttu fw-300 smooth">Read more</a>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>

			<div class="col-md-6 pad-0">
				<img src="<?= get_the_post_thumbnail_url( $page_about->ID, 'full' ) ?>" class="home-about__thumbnail">
			</div>
		</div>
	</div>
	
</section>

<section class="home-contact">
	<div class="container">
		<h3 class="fw-300 sz-60 txt-yl txt-center">CONTACT US</h3>
		<?php gravity_form( 1, false, false, $display_inactive = false, $field_values = null, $ajax = true, $tabindex, $echo = true ); ?>
	</div>
</section>

<?php
get_footer();