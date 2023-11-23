<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package base
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function base_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'base_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function base_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'base_pingback_header' );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
    global $post;
    return ' ... <a class="moretag" href="'. get_permalink($post->ID) . '"> Read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// hide wordpress version
function remove_version() {
    return '';
}
add_filter('the_generator', 'remove_version');

// hide login errors
function wrong_login() {
    return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');


// do not load the emoji js
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// do not load the mquery migrate js
add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );
function dequeue_jquery_migrate( &$scripts){
	if(!is_admin()){
		$scripts->remove( 'jquery');
		$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
	}
}

// do not load the wp embed js
function my_deregister_scripts(){
    wp_deregister_script( 'wp-embed' );
  }
add_action( 'wp_footer', 'my_deregister_scripts' );

// Tidy up admin menu
function post_remove () {
    // comments
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'post_remove');

// support for hero images and avoids calling in original images which are too large
add_image_size('hero', 1920); // crops wdth but allows unlimited height


// return all search results
function change_wp_search_size($query) {
    if ( $query->is_search ) // Make sure it is a search page
        $query->query_vars['posts_per_page'] = -1; // Change 10 to the number of posts you would like to show

    return $query; // Return our modified query variables
}
add_filter('pre_get_posts', 'change_wp_search_size'); // Hook our custom function onto the request filter






/* ACF functions */

