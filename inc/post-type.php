<?php
function gsk_register_post_type() {
    $slug = 'products';

    $labels = [
        'name'                  => _x( 'KeyCap', 'Product post type name', 'gsk' ),
        'singular_name'         => _x( 'KeyCap', 'Singular Product post type name', 'gsk' ),
        'add_new'               => __( 'New KeyCap', 'gsk' ),
        'add_new_item'          => __( 'Add New KeyCap', 'gsk' ),
        'edit_item'             => __( 'Edit KeyCap', 'gsk' ),
        'new_item'              => __( 'New KeyCap', 'gsk' ),
        'all_items'             => __( 'KeyCaps', 'gsk' ),
        'view_item'             => __( 'View KeyCap', 'gsk' ),
        'search_items'          => __( 'Search KeyCap', 'gsk' ),
        'not_found'             => __( 'No KeyCap found', 'gsk' ),
        'not_found_in_trash'    => __( 'No KeyCap found in Trash', 'gsk' ),
        'parent_item_colon'     => '',
        'menu_name'             => _x( 'KeyCap', 'Product post type menu name', 'gsk' ),
        'filter_items_list'     => __( 'Filter KeyCap list', 'gsk' ),
        'items_list_navigation' => __( 'KeyCap list navigation', 'gsk' ),
        'items_list'            => __( 'KeyCap list', 'gsk' ),
    ];

    $args = [
        'labels'             => $labels,
        'taxonomies'         => ['keycap_category'],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-layout',
        'menu_position'      => 2,
        'query_var'          => true,
        'rewrite'            => [
            'slug'       => untrailingslashit( $slug ),
            'with_front' => false,
            'feeds'      => true,
        ],
        'capability_type'    => 'post',
        'map_meta_cap'       => true,
        'hierarchical'       => false,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'author' ],
        'show_in_rest' 		 => true,
    ];
    register_post_type( 'product', $args );
}

add_action( 'init', 'gsk_register_post_type' );