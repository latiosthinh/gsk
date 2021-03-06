<?php
add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );

function your_prefix_register_meta_boxes( $meta_boxes ) {
	$prefix = 'gsk';

	$meta_boxes[] = array (
		'title'      => esc_html__( 'Product\'s Attribute', 'gsk' ),
		'id'         => 'products-attribute',
		'post_types' => array(
			0 => 'product',
		),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array (
				'id'            => $prefix . 'on_raffle',
				'name'          => esc_html__( 'On Raffle', 'gsk' ),
				'type'          => 'checkbox',
				'desc'          => esc_html__( 'Check this to put KeyCap on Raffle', 'gsk' ),
				'before'        => '<label class="switch">',
				'after'         => '</label>',
				'admin_columns' => true,
				'sort'          => true,
				'searchable'    => true,
				'admin_columns' => 'after title'
			),
			array (
				'id'         => $prefix . 'raffle_time',
				'type'       => 'datetime',
				'name'       => esc_html__( 'Raffle Time', 'gsk' ),
				'timestamp'  => 1,
				'js_options' => array(
					'dateFormat'      => 'dd-mm-yy',
					'showTimepicker'  => true,
				),
				'save_format' => 'Y-m-d H:i:s',
			),
			array (
				'id'         => $prefix . 'raffle_end_time',
				'type'       => 'datetime',
				'name'       => esc_html__( 'Raffle End Time', 'gsk' ),
				'timestamp'  => 1,
				'js_options' => array(
					'dateFormat'      => 'dd-mm-yy',
					'showTimepicker'  => true,
				),
				'save_format' => 'Y-m-d H:i:s',
			),
			array (
				'id'   => $prefix . 'shipping_date',
				'type' => 'date',
				'name' => esc_html__( 'Shipping Date', 'gsk' ),
			),
			[
				'id'   => $prefix . 'author',
				'type' => 'text',
				'name' => esc_html__( 'Author', 'gsk' ),
			],
			array (
				'id'     => $prefix . 'group_product',
				'type'   => 'group',
				'name'   => esc_html__( 'Item Group', 'gsk' ),
				'fields' => array(
					[
						'id'   => $prefix . 'gallery_name',
						'type' => 'text',
						'name' => esc_html__( 'Item\'s name', 'gsk' ),
					],
					array (
						'id'   => $prefix . 'gallery',
						'type' => 'image_advanced',
						'max_file_uploads' => 4,
						'max_status'       => false,
					),
				),
				'clone'         => 1,
				'default_state' => 'expanded',
			),
			[
				'id'   => $prefix . 'commission_name',
				'type' => 'text',
				'name' => esc_html__( 'Commission Name', 'gsk' ),
			],
			[
				'id'   => $prefix . 'commission_url',
				'type' => 'text',
				'name' => esc_html__( 'Commission URL', 'gsk' ),
			],
			[
				'id'   => $prefix . 'commission_img',
				'type' => 'image_advanced',
				'max_file_uploads' => 1,
				'max_status'       => false,
			],
		),
		'style'       => 'seamless',
		'text_domain' => 'gsk',
	);

	return $meta_boxes;
}