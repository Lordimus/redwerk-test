<?php

/**
 * Register post type RW Olx.
 */
function twentytwentyone_child_register_post_type_rw_olx() {
	register_post_type( 'rw_olx',
		array(
			'labels'      => array(
				'name'          => __( 'RW Olx', 'twentytwentyone' ),
				'singular_name' => __( 'RW Olx', 'twentytwentyone' )
			),
			'public'      => true,
			'has_archive' => true,
			'supports'    => array(
				'title',
			),
			'rewrite'     => array( 'slug' => 'rw-olx' ),
		)
	);
}

add_action( 'init', 'twentytwentyone_child_register_post_type_rw_olx' );

/**
 * Register category RW Olx type.
 */
function twentytwentyone_child_register_taxonomy_rw_olx_type() {
	register_taxonomy(
		'rw_olx_type',
		'rw_olx',
		array(
			'label'             => __( 'Type', 'twentytwentyone' ),
			'show_admin_column' => true,
			'rewrite'           => array(
				'slug'       => 'rw-olx-type',
				'with_front' => false
			),
			'hierarchical'      => true,
		)
	);
}

add_action( 'init', 'twentytwentyone_child_register_taxonomy_rw_olx_type' );