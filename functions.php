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
define( 'ADMIN', get_template_directory_uri() . '/admin' );

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
			[
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);

		add_image_size( 'thumb-385', 385, 385, true );
		add_image_size( 'thumb-315', 315, 170, true );
	}
endif;
add_action( 'after_setup_theme', 'gsk_setup' );

function gsk_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Side Filter', 'gsk' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'gsk' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Top Control', 'gsk' ),
			'id'            => 'sidebar-top',
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
	wp_enqueue_style( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css', [], _S_VERSION );

	wp_enqueue_style( 'gsk-style', get_stylesheet_uri(), [], _S_VERSION );


	wp_enqueue_script( 'gsk-navigation', JS. '/navigation.js', [], _S_VERSION, true );
	wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', [], _S_VERSION, true );
	wp_enqueue_script( 'gsk-skip-link-focus-fix', JS . '/skip-link-focus-fix.js', ['jquery'], _S_VERSION, true );
	wp_enqueue_script( 'gsk-script', JS . '/script.js', ['jquery'], _S_VERSION, true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gsk_scripts' );


function gsk_admin_script() {
	wp_enqueue_style( 'gsk-admin', ADMIN . '/admin.css', [], _S_VERSION );
}

add_action( 'admin_enqueue_scripts', 'gsk_admin_script', 10, 1 );


require get_template_directory() . '/inc/disable.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/gsk_metabox.php';

require get_template_directory() . '/inc/post-type.php';
require get_template_directory() . '/inc/taxonomy.php';

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-hooks.php';


if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function gsk_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 5,
            'min_rows'        => 2,
            'max_rows'        => 5,
            'default_columns' => 2,
            'min_columns'     => 2,
            'max_columns'     => 2,
        ),
	) );
	
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'gsk_add_woocommerce_support' );