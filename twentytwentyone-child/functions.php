<?php

define( 'TWENTYTWENTYONE_CHILD_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Enqueue scripts and styles.
 */
function twentytwentyone_child_scripts_styles() {
	wp_enqueue_style( 'twentytwentyone', get_template_directory_uri() . '/style.css' );

	wp_enqueue_style(
		'twentytwentyone-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'twentytwentyone',
		],
		TWENTYTWENTYONE_CHILD_VERSION
	);

	wp_enqueue_style(
		'twentytwentyone-child-custom-style',
		get_stylesheet_directory_uri() . '/dist/styles/front-end/index.css',
		null,
		TWENTYTWENTYONE_CHILD_VERSION
	);

	wp_enqueue_script(
		'twentytwentyone-child-custom-script',
		get_stylesheet_directory_uri() . '/dist/scripts/front-end/index.js',
		['jquery'],
		TWENTYTWENTYONE_CHILD_VERSION,
		true
	);
}

add_action( 'wp_enqueue_scripts', 'twentytwentyone_child_scripts_styles' );

/*
 * Enqueue admin scripts
 */
function twentytwentyone_child_admin_scripts_styles() {
	wp_enqueue_media();

	wp_enqueue_script(
		'twentytwentyone-child-admin-script',
		get_stylesheet_directory_uri() . '/dist/scripts/admin/index.js',
		['jquery', 'media-upload'],
		TWENTYTWENTYONE_CHILD_VERSION,
		true
	);
}

add_action('admin_enqueue_scripts', 'twentytwentyone_child_admin_scripts_styles');

/*
 * Add custom image size
 */
function twentytwentyone_child_add_image_size() {
	add_image_size('rw-olx-post', 768, 432, true);
}
add_action('after_setup_theme', 'twentytwentyone_child_add_image_size');

/*
 * Requeue files
 */
require_once('inc/post-types.php');
require_once('inc/meta-boxes.php');
require_once('inc/email-notice.php');
