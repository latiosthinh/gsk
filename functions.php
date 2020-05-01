<?php
/**
 * gsk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gsk
 */

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

define( 'JS', get_template_directory_uri() . '/js' );
define( 'IMG', get_template_directory_uri() . '/images' );

if ( ! function_exists( 'gsk_setup' ) ) :
	function gsk_setup() {
		load_theme_textdomain( 'gsk', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'gsk' ),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'gsk_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'gsk_setup' );

function gsk_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'gsk' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gsk' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'gsk_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function gsk_scripts() {
	wp_enqueue_style( 'gsk-style', get_stylesheet_uri(), [], _S_VERSION );


	wp_enqueue_script( 'gsk-navigation', JS. '/navigation.js', [], _S_VERSION, true );
	wp_enqueue_script( 'gsk-skip-link-focus-fix', JS . '/skip-link-focus-fix.js', [], _S_VERSION, true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gsk_scripts' );



require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';



if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

