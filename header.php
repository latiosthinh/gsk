<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gsk
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'gsk' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-nav">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
			</div>

			<ul class="actions">
				<li><a class="ttu sz-16 fw-300" href="<?php echo home_url( 'dashboard' ) ?>">Login</a></li>
				<li><a class="ttu sz-16 fw-300" href="<?php echo home_url( 'cart' ) ?>">Cart (<?php echo "0" ?>)</a></li>
			</ul>

			<nav id="site-navigation" class="main-navigation container-fluid">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'gsk' ); ?></button>
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					]
				);
				?>
			</nav><!-- #site-navigation -->

		</div>

		<?php if ( is_front_page() ) : ?>
			<h1 class="fd sz-250 txt-yl stroke text-title">GSK</h1>
		<?php endif; ?>

		<?php if ( is_page_template( 'templates/catalog.php' ) ) : ?>
			<h1 class="fd sz-110 txt-yl stroke text-title">CATALOG</h1>
		<?php endif; ?>

		<?php if ( is_page_template( 'templates/dashboard.php' ) ) : ?>
			<h1 class="fd sz-80 txt-yl stroke text-title">DASHBOARD</h1>
		<?php endif; ?>

		<?php if ( is_home() ) : ?>
			<h1 class="fd sz-110 txt-yl stroke text-title">STORY</h1>
		<?php endif; ?>

		<?php if ( is_shop() || is_product() ) : ?>
			<h1 class="fd sz-130 txt-yl stroke text-title">SHOP</h1>
		<?php endif; ?>

		<img class="header-vector" src="<?php echo IMG . '/header-vector.png' ?>">

		<!-- Raffle begin -->
		<div class="site-raffle">
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
		</div>
		<!-- Raffle end -->

		<a class="btn bg-yl ttu fw-300 smooth see-more" href="<?php the_permalink() ?>">See more</a>

	</header><!-- #masthead -->
