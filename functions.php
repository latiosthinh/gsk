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

		add_image_size( 'thumb-500', 470, 470, true );
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

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'gsk' ),
			'id'            => 'sidebar-footer',
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
	wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css', [], _S_VERSION );

	wp_enqueue_style( 'gsk-style', get_stylesheet_uri(), [], _S_VERSION );


	wp_enqueue_script( 'gsk-navigation', JS. '/navigation.js', [], _S_VERSION, true );
	wp_enqueue_script( 'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', [ 'jquery' ], _S_VERSION, true );
	wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', ['jquery'], _S_VERSION, true );
	wp_enqueue_script( 'gsk-skip-link-focus-fix', JS . '/skip-link-focus-fix.js', ['jquery'], _S_VERSION, true );
	wp_enqueue_script( 'gsk-script', JS . '/script.js', ['jquery'], _S_VERSION, true );
	wp_enqueue_script( 'gsk-countdown', JS . '/countdown.js', ['jquery'], _S_VERSION, true );

	if ( is_page( 'catalog' ) ) {
		wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', [], _S_VERSION );
		wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', ['jquery'], _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$curUser = wp_get_current_user();
	$curUserData = get_user_meta( $curUser->ID );

	$email = get_userdata( $curUser->ID )->user_email;
	$ip = $curUserData[ 'gsk_ip_address' ][ 0 ];

	$data = [
		'home_url'  => home_url(),
		'ajax_url'  => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'ajax_nonce' ),
		'js_dir'    => JS,
		'img_dir'	=> IMG,
		'ip'        => $ip,
		'email'		=> $email,
	];

	wp_localize_script( 'gsk-script', 'php_data', $data );
}
add_action( 'wp_enqueue_scripts', 'gsk_scripts' );


function gsk_admin_script() {
	wp_enqueue_style( 'gsk-admin', ADMIN . '/admin.css', [], _S_VERSION );
	wp_enqueue_script( 'gsk-admin', ADMIN . '/admin.js', [ 'jquery' ], _S_VERSION );
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

add_action( 'user_register', 'gsk_get_user_ip' );

function gsk_get_user_ip( $user_id ) {
	if ( ! empty($_SERVER['HTTP_CLIENT_IP']) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	update_user_meta( $user_id, 'gsk_ip_address', $ip );
}

add_filter( 'rwmb_profile_after_save_user', function() {
	wp_redirect( home_url( '/my-account' ) );
	die;
}, 10, 2 );

// user enrolled
function submit_enroll() {
	$data_ajax = (array) $_POST;
	
	$curUser = wp_get_current_user();
	$chosen_items = '';

	foreach ($data_ajax['chosen'] as $item ) {
		$chosen_items .= $item . ',';	
	}

	update_user_meta( $curUser->ID, 'enroll', $data_ajax['id'] );
	update_user_meta( $curUser->ID, 'enroll_items',$chosen_items );

	$response = [
		'status' => 'success',
		'data'   => $data_ajax
	];

	header('Content-type:application/json;charset=utf-8');
	echo json_encode( $response );
	die;
}

add_action('wp_ajax_enroll', 'submit_enroll');
add_action('wp_ajax_nopriv_enroll', 'submit_enroll');


// get winner
function get_user_raffle() {
	$data_ajax = (array) $_POST;
	$html = '';

	foreach ( $data_ajax['user_ids'] as $id ) :
		$ip       = get_user_meta( $id, 'gsk_ip_address' )[0];
		$banned   = get_user_meta( $id, 'banned' )[0];
		$items    = get_user_meta( $id, 'enroll_items', true );
		$phone    = get_user_meta( $id, 'billing_phone', true );
		$can_roll = '1' !== $banned ? 'can-roll' : '';
		$user = get_userdata( $id );
		$home_url = home_url();

		$html .= "
			<tr>
				<td class='item-to-save'
					data-raffle-id='{$data_ajax['raffle_id']}'
					data-raffle-item='{$data_ajax['raffle_item']}'
				>{$id}</td>
				<td>
					<a href='{$home_url}/wp-admin/user-edit.php?user_id={$id}&wp_http_referer=%2Fwp-admin%2Fusers.php' target='_blank'>
					{$user->display_name}
					</a>
				</td>
				<td>{$user->user_email}</td>
				<td>{$phone}</td>
				<td class='user-item {$can_roll}'
					data-user-id='{$id}'
					data-user-items='{$items}'>
					{$items}
				</td>
				<td>{$ip}</td>
				<td><button class='enrolled-ban' data-id='{$id}' data-b='1'>BAN</button></td>
			</tr>";
	endforeach;
	
	$response = [
		'status' => 'success',
		'data'   => $html
	];

	header('Content-type:application/json;charset=utf-8');
	echo json_encode( $response );
	die;
}

add_action('wp_ajax_get_raffle_winner', 'get_user_raffle');
add_action('wp_ajax_nopriv_get_raffle_winner', 'get_user_raffle');


// ban user
function submit_banned() {
	$data_ajax = (array) $_POST;
	
	$user_id = $data_ajax['id'];
	
	update_user_meta( $user_id, 'banned', $data_ajax['banned'] );
	
	$response = [
		'status' => 'success',
		'data' => $data_ajax
	];

	header('Content-type:application/json;charset=utf-8');
	echo json_encode( $response );
	die;
}

add_action('wp_ajax_banned', 'submit_banned');
add_action('wp_ajax_nopriv_banned', 'submit_banned');


// create post raffle
function submit_raffle() {
	$data_ajax = (array) $_POST;
	
	foreach ( $data_ajax[ 'user_id' ] as $uid ) {
		$default_data = get_user_meta( $uid, 'enroll_win', true ) . '|' . $data_ajax[ 'raffle_id' ] . '-' . $data_ajax[ 'raffle_item' ];
		update_user_meta( $uid, 'enroll_win', $default_data );
	}

	$response = [
		'status' => 'success',
		'data' => $data_ajax
	];

	header('Content-type:application/json;charset=utf-8');
	echo json_encode( $response );
	die;
}

add_action('wp_ajax_add_raffle', 'submit_raffle');
add_action('wp_ajax_nopriv_add_raffle', 'submit_raffle');

// end raffle
function end_raffle() {
	$data_ajax = (array) $_POST;

	$args = [
		'post_type'  => 'product',
		'p'          => $data_ajax[ 'post_id' ],
	];

	$raffle = new WP_Query($args);

	if ( $raffle->have_posts() ) :
		while ( $raffle->have_posts() ) : $raffle->the_post();
			update_post_meta( get_the_ID(), 'gskon_raffle', '0' );
		endwhile;
	endif;
	
	wp_reset_postdata();
	
	$response = [
		'status' => 'success',
		'data'   => $data_ajax
	];

	header('Content-type:application/json;charset=utf-8');
	echo json_encode( $response );
	die;
}

add_action('wp_ajax_off_raffle', 'end_raffle');
add_action('wp_ajax_nopriv_off_raffle', 'end_raffle');

function gsk_registration_redirect() {
	return home_url('/my-account/edit-account');
}
add_action('woocommerce_registration_redirect', 'gsk_registration_redirect', 2);


add_filter( 'facetwp_facet_html', function( $html, $args ) {

	if ( 'checkboxes' == $args['facet']['type']) {

		$pattern = '/<div class="facetwp-checkbox[^"]*" data-value="[^"]*">([^<]*) <span/';
		preg_match_all( $pattern, $html, $matches );

		if ( !empty($matches[1]) ) {
			foreach ( $matches[1] AS $label ) {
				$html = str_replace( '>' . $label . ' <span', '><span class="fwp_label">' . $label . '</span> <span', $html );
			}
		}
	}

	return $html;

}, 10, 2);