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
			<?php the_custom_logo(); ?>

			<ul class="action">
				<li><a class="ttu sz-16 fw-300" href="<?php echo home_url( 'login' ) ?>">Login</a></li>
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

		<h1 class="fd sz-250 txt-yl stroke">GSK</h1>

		<!-- Raffle begin -->
		<?php get_template_part( 'template-parts/raffle/content-raffle' ); ?>
		<!-- Raffle end -->

	</header><!-- #masthead -->
