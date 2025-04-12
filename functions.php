<?php
/**
 * Twenty Twenty-Five WSB child functions and definitions.
 *
 */

function wsb_2025_enqueue_styles() {
	$parent_style = 'twentytwentyfive-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version')
	);
}

add_action('wp_enqueue_scripts', 'wsb_2025_enqueue_styles');