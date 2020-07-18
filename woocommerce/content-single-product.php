<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$curUser = wp_get_current_user();
$is_enrolled = get_user_meta( $curUser->ID, 'enroll' )[0];
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-5">
			<div class="product-gallery">
			<?php
			$group_product = rwmb_meta( 'gskgroup_product' );
			$i = 0;

			foreach( $group_product as $group ) {
			?>
				<div class="product-gallery__panel" id="product-gallery-<?= $i ?>">
					<div class="product-gallery__flash">
						<?php
							foreach ( $group['gskgallery'] as $image ) {
								echo wp_get_attachment_image( $image, 'thumb-500' );
							}
						?>
					</div>

					<div class="product-gallery__nav">
						<?php
							foreach ( $group['gskgallery'] as $image ) {
								echo wp_get_attachment_image( $image );
							}
						?>
					</div>
				</div>
			<?php
				$i++;
			} 
			?>
			</div>
		</div>

		<div class="col-md-5">
			<div class="summary entry-summary">
				<?php
				woocommerce_template_single_title();
				// woocommerce_template_single_meta();
				the_content();
				?>

				<div class="actions">
					<h4>AVAILABLE ITEMS</h4>
					<div class="actions-slider">
						<div><?php get_first_image( get_the_id() ); ?></div>
						<?php woocommerce_template_single_price(); ?>

						<h3 class="actions-slider__name"></h3>
					</div>
					
					<div class="actions-login-buy">
						<?php
						// woocommerce_template_single_excerpt();

						if ( is_user_logged_in() && ! rwmb_meta( 'gskon_raffle' ) ) :
							woocommerce_template_single_add_to_cart();
						elseif ( ! is_user_logged_in() && ! rwmb_meta( 'gskon_raffle' ) ) :
						?>
								<a class="ttu sz-16 fw-300 login-request no-raffle" href="<?php echo home_url( 'dashboard' ) ?>">Login Request</a>
						<?php
						elseif ( is_user_logged_in() && rwmb_meta( 'gskon_raffle' ) ) :
						?>
							<p class="countdown"></p>
							<?php if ( $is_enrolled ) : ?>
								<a id="open-enroll-btn" class="ttu sz-16 fw-300 login-request enrolled">Enrolled</a>
							<?php else: ?>
								<a id="open-enroll-btn" class="ttu sz-16 fw-300 login-request time-out">Enroll</a>
							<?php endif; ?>
						<?php
						elseif ( ! is_user_logged_in() && rwmb_meta( 'gskon_raffle' ) ) :
						?>
							<p class="countdown"></p>
							<a class="ttu sz-16 fw-300 login-request" href="<?php echo home_url( 'dashboard' ) ?>">Login Request</a>
						<?php
						endif;
						?>
					</div>

					<?php woocommerce_template_single_sharing(); ?>

					<p class="author"><?= rwmb_meta( 'gskauthor' ); ?></p>

					<?php if ( rwmb_meta( 'gskshipping_date' ) ) : ?>
					<p class="shipping-date">Expected shipping date is <?= rwmb_meta( 'gskshipping_date' ) ?></p>
					<?php  endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<?php if ( rwmb_meta( 'gskon_raffle' ) ) : ?>
				<img class="product-desc__img" src="<?= IMG . '/wish.png' ?>">
				<img class="product-desc__img" src="<?= IMG . '/rule.png' ?>">
			<?php endif; ?>

			<?php woocommerce_output_related_products(); ?>
		</div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	// do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<div class="enroll-popup">
	<div class="enroll-popup__overlay"></div>

	<div class="enroll-popup__content">
		<h3>Choose item(s) to enroll</h3>

		<div class="enroll-popup__content__items">
			<?php get_first_image_enroll( get_the_id() ); ?>
		</div>
		
		<p class="enroll-alert">Enroll Successed (close) </p>
		<a id="enroll-btn" data-id="<?= get_the_ID() ?>" class="ttu sz-16 fw-300 unactive">Enroll</a>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
