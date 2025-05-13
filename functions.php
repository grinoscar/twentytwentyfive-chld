<?php
/**
 * Twenty Twenty-Five WSB child functions and definitions.
 *
 */

 function wsb_2025_enqueue_styles()
 {
   $parent_style = 'twentytwentyfive-style';
   wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
   wp_enqueue_style(
     'child-style',
     get_stylesheet_directory_uri() . '/style.css',
     array($parent_style),
     wp_get_theme()->get('Version')
   );
 }
 
 add_action('wp_enqueue_scripts', 'wsb_2025_enqueue_styles');

/**
 * WordPress function for redirecting users on login based on user role
 */
function wpdocs_my_login_redirect($url, $request, $user)
{
  if ($user && is_object($user) && is_a($user, 'WP_User')) {
    if ($user->has_cap('administrator')) {
      $url = admin_url();
    } else {
      $url = home_url('/');
    }
  }
  return $url;
}

add_filter('login_redirect', 'wpdocs_my_login_redirect', 10, 3);

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
  if (!current_user_can('administrator') && !is_admin()) {
    add_filter('show_admin_bar', '__return_false');
  }
}

function university_files()
{
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'university_files');

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  return get_bloginfo('name');
}

// Register our new blocks
function wsb_new_blocks() {
  register_block_type_from_metadata(__DIR__ . '/build/footer');
  register_block_type_from_metadata(__DIR__ . '/build/header');
}

add_action('init', 'wsb_new_blocks');
// new PlaceholderBlock("header");

register_nav_menus(
  array(
    'logged-in' => __('Logged In Menu'),
    'logged-out' => __('Logged Out Menu')
  )
);

function myallowedblocks($allowed_block_types, $editor_context) {
  // If you are on a page/post editor screen
  if (!empty($editor_context->post)) {
    return $allowed_block_types;
  }

  // if you are on the FSE screen
  return array('wsbtheme/header', 'wsbtheme/footer');
}

// Uncomment the line below if you actually want to restrict which block types are allowed
//add_filter('allowed_block_types_all', 'myallowedblocks', 10, 2);

// // custom navigation???
// function my_wp_nav_menu_args( $args = '' ) {
//   if( is_user_logged_in() ) {
//   // Logged in menu to display
//   $args['menu'] = 3067;

//   } else {
//   // Non-logged-in menu to display
//   $args['menu'] = 3061;
//   }
//   return $args;
//   }
//   add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );