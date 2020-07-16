<?php
/**
 * Template name: Commission
 */

get_header();
?>

<section class="selection">
	<div class="name">
		<h3>SKETCHES <br> SELECTION</h3>
	</div>
	<img src="<?php echo IMG . '/sketches.png' ?>">
</section>

<?php
wp_reset_postdata();

$parent = get_term_by( 'name', 'commission', 'product_cat' );

$args = array(
	'hierarchical'     => 1,
	'show_option_none' => '',
	'hide_empty'       => 0,
	'parent'           => $parent->term_id,
	'taxonomy'         => 'product_cat'
);

$children = get_categories( $args );

foreach ( $children as $child ) :
?>

<section class="company">
	<h3>GSK <?= $child->name ?></h3>

	<div class="list container">
		<div class="row flex-center">
			<?php
			$args_2 = [
				'post_type' => 'product',
				'tax_query'             => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $child->term_id,
						'operator' => 'IN'
					),
				)
			];

			$products = new WP_Query( $args_2 );

			if ( $products->have_posts() ) :
				while ( $products->have_posts() ) : $products->the_post();
			?>
					<div class="item">
						<?php the_post_thumbnail( 'thumb-385' ) ?>

						<h2><?php echo rwmb_meta( 'gskcommission_name' ); ?></h2>

						<?php if ( rwmb_meta( 'gskcommission_url' ) ) : ?>
							<a class="btn bg-yl" href="<?php echo rwmb_meta( 'gskcommission_url' ) ?>" target="_blank">DOWNLOAD</a>
						<?php elseif ( rwmb_meta( 'gskcommission_img' ) ) : ?>
							<?php foreach ( rwmb_meta( 'gskcommission_img', ['size' => 'thumbnail'] ) as $img ) : ?>
							<a class="btn bg-yl" href="<?php echo $img[ 'full_url' ]; ?>" target="_blank">DOWNLOAD</a>
							<?php endforeach; ?>
						<?php else : ?>
							<a class="btn bg-yl" href="#">DOWNLOAD</a>
						<?php endif; ?>
					</div>
			<?php
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<?php endforeach; ?>

<section class="submission">
	<div class="top">
		<h3>Commission <br> submission</h3>
		<img src="<?php echo IMG . '/sketches.png' ?>">
	</div>
	<div class="content">
		<?php echo rwmb_meta( 'submission_content' ) ?>
	</div>
</>

<section class="submission">
	<div class="top">
		<h3>Commission <br> price</h3>
		<img src="<?php echo IMG . '/sketches.png' ?>">
	</div>
	<div class="content">
		<?php echo rwmb_meta( 'price_content' ) ?>
	</div>
</section>

<?php
get_footer();