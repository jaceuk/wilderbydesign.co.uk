<?php

/**
 * @snippet       Add "Quantity:" before Add to Cart Button - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 8
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_action('woocommerce_before_add_to_cart_quantity', 'bbloomer_echo_qty_front_add_cart', 10);

function bbloomer_echo_qty_front_add_cart()
{
  global $product;
  if ($product->get_min_purchase_quantity() == $product->get_max_purchase_quantity()) return;
  echo '<label>Quantity: </label>';
}

// remove additional information and description tabs from single product page
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
  unset($tabs['additional_information']);
  unset($tabs['description']);
  return $tabs;
}

/********
// change variations from select list to buttons
 ********/
// add_filter('woocommerce_dropdown_variation_attribute_options_html', 'rudr_radio_variations', 20, 2);
// function rudr_radio_variations($html, $args)
// {

//   // in wc_dropdown_variation_attribute_options() they also extract all the array elements into variables
//   $options   = $args['options'];
//   $product   = $args['product'];
//   $attribute = $args['attribute'];
//   $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
//   $id        = $args['id'] ? $args['id'] : sanitize_title($attribute);
//   $class     = $args['class'];

//   if (empty($options) || !$product) {
//     return $html;
//   }

//   // HTML for our radio buttons
//   $radios = '<div class="variation-buttons">';

//   // taxonomy-based attributes
//   if (taxonomy_exists($attribute)) {

//     $terms = wc_get_product_terms(
//       $product->get_id(),
//       $attribute,
//       array(
//         'fields' => 'all',
//       )
//     );

//     foreach ($terms as $term) {
//       if (in_array($term->slug, $options, true)) {
//         $colour = get_field('colour', 'term_' . $term->term_id);
//         $text = $colour ? '' : $term->name;
//         $class = $colour ? 'colour' : '';
//         $radios .= '<button class="variation-button ' . $class . '" data-name="' . $name . '" data-value="' . $term->slug . '" style="background: ' . $colour . '">' . $text;
//       }
//     }
//     // individual product attributes
//   } else {
//     foreach ($options as $option) {
//       // non-color attribute buttons
//       // $checked = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
//       $radios .= "<button class=\"variation-button\" data-name=\"{$name}\" data-value=\"{$option}\">{$option}";
//     }
//   }

//   $radios .= '</button>';

//   return $html . $radios;
// }

/** Show variable prices just above the variations */
function move_variation_price()
{
  remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
  add_action('woocommerce_before_variations_form', 'woocommerce_single_variation', 10);
}
add_action('woocommerce_before_add_to_cart_form', 'move_variation_price');

/*
 * Content before product meta
 */
add_action('woocommerce_product_meta_start', 'add_content_before_product_meta');
function add_content_before_product_meta()
{
  get_template_part('components/product-meta');
}

/*
 * Fixed issue where variable products with the same price for all variations display the single proruct price block
 * instead of the expected variable price block
 */
add_filter('woocommerce_available_variation', function ($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
  if (empty($available_variations['price_html'])) {
    $available_variations['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
  }

  return $available_variations;
}, 10, 3);


// Size guide modal
add_action('woocommerce_before_add_to_cart_button', 'size_guide_modal');
function size_guide_modal()
{
  global $post;
  // get parent category
  $categories = get_the_terms($post->ID, 'product_cat');

  foreach ($categories as $category) {
    $cat_id =  $category->term_id;
  }

  $cat_size_guide = get_field('cat_size_guide', 'product_cat_' . $cat_id);
?>
  <dialog id="size-guide-dialog" class="dialog size-guide">
    <button id="close-dialog" class="dialog-close-button" type="button" onclick="closeDialog('size-guide-dialog')">
      <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
      </svg>
    </button>

    <div class="dialog-body">
      <h2>Size guide (inches)</h2>
      <?php
      echo $cat_size_guide;
      ?>
    </div>
  </dialog>
<?php
}


// show new product reviews first
add_filter('woocommerce_product_review_list_args', 'new_reviews_first');
function new_reviews_first($args)
{
  $args['reverse_top_level'] = true;
  return $args;
}


add_filter('woocommerce_before_variations_form', 'test');
function test($args)
{
  // get parent category
  global $post;
  $categories = get_the_terms($post->ID, 'product_cat');

  foreach ($categories as $category) {
    $cat_id =  $category->term_id;
  }

  $cat_size_guide = get_field('cat_size_guide', 'product_cat_' . $cat_id);
?>
  <div class="price-and-size-guide-trigger">
    <button id="newsletter-dialog-trigger" type="button" class="save-button product-page-save-button" onclick="openDialog('newsletter-dialog')">Save an extra 10%</button>
    <?php if ($cat_size_guide) { ?>
      <button class="size-guide-trigger" id="size-guide-trigger" type="button" onclick="openDialog('size-guide-dialog')">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#151922">
          <path d="m264-569-61 36q-12 8-26 4t-21-17L96-652q-7-12-4.5-25t16.5-21l206-122h56q11 0 17.5 6.5T394-796v12q0 36 25 61t61 25q36 0 61-25t25-61v-12q0-11 6.5-17.5T590-820h56l206 122q14 8 16.5 21t-4.5 25l-60 106q-7 13-21.5 17t-25.5-4l-61-38v397q0 15-9.5 24.5T662-140H298q-15 0-24.5-9.5T264-174v-395Zm54-91v466h324v-466l124 69 42-71-161-96h-33q-9 50-46.5 82T480-644q-53 0-89-32t-45-82h-33l-161 96 42 71 124-69Zm162 184Z"></path>
        </svg> Size guide
      </button>
    <?php } ?>

  </div>
  <?php
}



// show dialog when adding back-print to cart
// Check category on add to cart and pass flag to JS
add_action('woocommerce_add_to_cart', function ($cart_item_key, $product_id) {
  $terms = get_the_terms($product_id, 'product_cat');

  if (! empty($terms) && ! is_wp_error($terms)) {
    foreach ($terms as $term) {
      if (strpos($term->slug, 'back-print') !== false) {
        WC()->session->set('show_category_popup', true);
        break; // no need to keep checking
      }
    }
  }
}, 10, 2);

// Output vanilla JS to trigger dialog
add_action('wp_footer', function () {
  if (WC()->session && WC()->session->get('show_category_popup')) {
  ?>
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function() {
        // Replace with your custom modal logic
        openDialog('back-print-dialog');
      });
    </script>
<?php
    // Clear flag so it only runs once
    WC()->session->__unset('show_category_popup');
  }
});



add_action('wp_enqueue_scripts', function () {
  // Load late and in the footer so it sees Woo scripts & Blocks.
  wp_enqueue_script(
    'atc-loading-vanilla',
    get_stylesheet_directory_uri() . '/js/atc-loading-vanilla.js',
    [], // no jQuery dependency
    '1.2',
    true
  );
}, 100);
