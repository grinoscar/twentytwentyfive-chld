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

/**
 * WordPress function for redirecting users on login based on user role
 */
function wpdocs_my_login_redirect( $url, $request, $user ) {
    if ( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if ( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url( '/' );
        }
    }
    return $url;
}

add_filter( 'login_redirect', 'wpdocs_my_login_redirect', 10, 3 );

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    add_filter('show_admin_bar', '__return_false');
  }
}