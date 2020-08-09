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
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span></span></button>
			<div class="site-branding">
				<?php the_custom_logo(); ?>
			</div>

			<ul class="actions">
				<li><a class="ttu sz-16 fw-300" href="<?php echo home_url( '/my-account' ) ?>">Account</a></li>

				<?php
				global $woocommerce;
				$number = $woocommerce->cart->cart_contents_count;
				?>
				<li><a class="ttu sz-16 fw-300" href="<?php echo home_url( 'cart' ) ?>">Cart (<?php echo $number ?>)</a></li>
			</ul>

			<nav id="site-navigation" class="main-navigation container-fluid">
				<?php if ( current_user_can( 'manage_options' ) ) : ?>
					<a href="<?= home_url( '/users' ); ?>"><?php esc_html_e( 'Users' , 'gsk' ) ?></a>
				<?php endif; ?>
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
				'posts_per_page' => 1,
				'meta_query' => [
					[
						'key'   => 'gskon_raffle',
						'value' => '1',
					],
					[
						'key'     => 'gskraffle_end_time',
						'value'   => date("Y-m-d H:i"),
						'compare' => '<'
					],
				],
			];

			$raffle = new WP_Query($args);
			$raffle_url = '';

			global $raffle_id;

			if ( $raffle->have_posts() ) :
				while ( $raffle->have_posts() ) : $raffle->the_post();

						get_template_part( 'template-parts/raffle/content-raffle' );
						$raffle_url = get_the_permalink();
						$raffle_id = get_the_ID();
					
				endwhile;
			else :
				$args = [
					'post_type'      => 'product',
					'posts_per_page' => 1,
					'meta_query'     => [
						[
							'key'   => 'gskon_raffle',
							'value' => '1',
						],
					],
				];
	
				$raffle = new WP_Query($args);
				$raffle_url = '';
	
				if ( $raffle->have_posts() ) :
					while ( $raffle->have_posts() ) : $raffle->the_post();
	
							get_template_part( 'template-parts/raffle/content-raffle' );
							$raffle_url = get_the_permalink();
						
					endwhile;
				endif;
				
				wp_reset_postdata();
			endif;
			
			wp_reset_postdata();
		?>
		</div>
		<!-- Raffle end -->

		<a class="btn bg-yl ttu fw-300 smooth see-more" href="<?= $raffle_url; ?>">See more</a>


	</header><!-- #masthead -->
