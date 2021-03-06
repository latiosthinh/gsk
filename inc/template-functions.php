<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package gsk
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gsk_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'gsk_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function gsk_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'gsk_pingback_header' );

function get_url_by_template( $template ){
	wp_reset_query();
	$url = null;
	
    $pages = query_posts( array(
		'post_type' =>'page',
		'meta_key'  =>'_wp_page_template',
		'meta_value'=> $template->name
	) );
	
    if ( isset( $pages[0] ) ) {
        $url = get_page_link( $pages[0]->ID );
	}
	
    return $url;
}

function get_page_id_by_template( $template ) {
    $args = [
		'post_type'  => 'page',
		'fields'     => 'ids',
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template->name
	];
	
	$pages = query_posts( $args );
	
	if ( ! isset( $pages[0] ) ) {
		return;
	}

    return $pages;
}

function get_first_image( $id ) {
	$group_product = rwmb_meta( 'gskgroup_product', $id );
	$i = 0;

	foreach( $group_product as $group ) {
?>
		<a class="product-gallery__link" data-href="#product-gallery-<?= $i ?>" data-name="<?= $group['gskgallery_name']; ?>">
			<?php echo wp_get_attachment_image( $group['gskgallery'][0] ); ?>
		</a>
<?php
		$i++;
	}
}

function get_first_image_enroll( $id ) {
	$group_product = rwmb_meta( 'gskgroup_product', $id );
	$i = 0;

	foreach( $group_product as $group ) {
?>
		<a class="product-item-enroll" data-name="<?= $group['gskgallery_name']; ?>">
			<span>
				<?php echo wp_get_attachment_image( $group['gskgallery'][0] ); ?>
			</span>

			<span><?= $group['gskgallery_name']; ?></span>
		</a>
<?php
		$i++;
	}
}