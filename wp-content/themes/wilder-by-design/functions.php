<?php

/**
 * Rude by Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rude_by_Design
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '2.0.4');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rude_by_design_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Rude by Design, use a find and replace
		* to change 'rude-by-design' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('rude-by-design', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'rude_by_design_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rude_by_design_content_width()
{
	$GLOBALS['content_width'] = apply_filters('rude_by_design_content_width', 640);
}
add_action('after_setup_theme', 'rude_by_design_content_width', 0);

/**
 * Add support for menus.
 *
 */
add_theme_support('menus');

add_action('init', 'register_my_menus');

function register_my_menus()
{
	register_nav_menus(
		array(
			'home-and-living-menu' => __('Home & Living Menu'),
			'clothing-menu' => __('Clothing Menu')
		)
	);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rude_by_design_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Currency Switcher', 'rude-by-design'),
			'id'            => 'currency-switcher',
			'description'   => esc_html__('Add widgets here.', 'rude-by-design'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'rude_by_design_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function rude_by_design_scripts()
{
	wp_enqueue_style('rude-by-design-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_script('rude-by-design-navigation', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'rude_by_design_scripts');

// remove admin bar
add_filter('show_admin_bar', '__return_false');

// prevent empty search
add_filter('posts_search', function ($search, \WP_Query $q) {
	if (!is_admin() && empty($search) && $q->is_search() && $q->is_main_query())
		$search .= " AND 0=1 ";

	return $search;
}, 10, 2);


/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}


// Facebook compatibility
function fb_opengraph()
{
	global $post;

	if (!$post) return;

	if (is_product() || is_product_category()) {
		if (has_post_thumbnail($post->ID)) {
			$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
			$img_src = $img_src[0];
		} else {
			$img_src = get_stylesheet_directory_uri() . '/img/opengraph_image.jpg';
		}
		if ($excerpt = $post->post_excerpt) {
			$excerpt = strip_tags($post->post_excerpt);
			$excerpt = str_replace("", "'", $excerpt);
		} else {
			$excerpt = get_bloginfo('description');
		}
?>

		<meta property="og:title" content="<?php echo the_title(); ?>" />
		<meta property="og:description" content="<?php echo $excerpt; ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo the_permalink(); ?>" />
		<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>" />
		<meta property="og:image" content="<?php echo $img_src; ?>" />

<?php
	} else {
		return;
	}
}
add_action('wp_head', 'fb_opengraph', 5);


// change added to cart message
function custom_add_to_cart_message_html($message, $products)
{
	$count = 0;
	foreach ($products as $product_id => $qty) {
		$count += $qty;
	}
	// The custom message is just below
	$added_text = sprintf(
		_n("%s item has %s", "%s items have %s", $count, "woocommerce"),
		$count,
		__("been added to your basket.", "woocommerce")
	);

	// added to cart success message
	if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
		$return_to = apply_filters('woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect(wc_get_raw_referer(), false) : wc_get_page_permalink('shop'));
		$message   = sprintf('<a href="%s" class="button wc-forward">%s</a> %s', esc_url($return_to), esc_html__('Continue shopping', 'woocommerce'), esc_html($added_text));
	} else {
		$message   = sprintf('<a href="%s" class="button wc-forward">%s</a> %s', esc_url(wc_get_page_permalink('cart')), esc_html__('View cart', 'woocommerce'), esc_html($added_text));
	}
	return $message;
}
add_filter('wc_add_to_cart_message_html', 'custom_add_to_cart_message_html', 10, 2);

// change variabe price format
function change_variable_products_price_display($price, $product)
{

	// Only for variable products type
	if (!$product->is_type('variable')) return $price;

	$prices = $product->get_variation_prices(true);

	if (empty($prices['price']))
		return apply_filters('woocommerce_variable_empty_price_html', '', $product);

	$min_price = current($prices['price']);
	$max_price = end($prices['price']);
	$prefix_html = '<span class="price-prefix">' . __('From ') . '</span>';

	$prefix = $min_price !== $max_price ? $prefix_html : ''; // HERE the prefix

	return apply_filters('woocommerce_variable_price_html', $prefix . wc_price($min_price) . $product->get_price_suffix(), $product);
}
add_filter('woocommerce_get_price_html', 'change_variable_products_price_display', 10, 2);
