<?php
// get parent category
$categories = get_the_terms($post->ID, 'product_cat');

// a product should only have one category
foreach ($categories as $category) {
  $cat_id =  $category->term_id;
}

$cat_size_guide = get_field('cat_size_guide', 'product_cat_' . $cat_id);
$prod_description = wc_get_product($post->ID)->get_description();
$cat_description = get_field('description_for_the_single_product_page', 'product_cat_' . $cat_id);
$cat_care_instructions = get_field('cat_care_instructions', 'product_cat_' . $cat_id);
$cat_shipping_returns = get_field('cat_shipping_returns', 'product_cat_' . $cat_id);
$cat_safety_information = get_field('cat_safety_information', 'product_cat_' . $cat_id);

$brands = get_the_terms($post->ID, 'product_brand');

// a product should only have one brand
if ($brands) {
  foreach ($brands as $brand) {
    $brand_id =  $brand->term_id;
    $brand_link =  get_term_link($brand);
  }
}
?>

<?php
get_template_part('components/benefits-beneath-button');
?>

<div class="product-meta">
  <?php if (isset($brand_id)) { ?>
    <div class="accordion" tabindex="0">
      <label class="h4" for="products-select">This design is also available in ...</label>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel">
      <form>
        <select id="products-select">
          <option value="">Select a product ...</option>
          <?php
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'tax_query'      => array(array(
              'taxonomy'        => 'product_brand',
              'field'           => 'id',
              'terms'           =>  $brand_id,
              'operator'        => 'IN',
            )),
            'post__not_in' => [$post->ID],
          );
          $products_with_same_design = new WP_Query($args);

          foreach ($products_with_same_design->posts as $product) {
            $product_link = get_permalink($product->ID);
            $product_categories = wp_get_post_terms($product->ID, 'product_cat');
            // a product should only have one category
            foreach ($product_categories as $category) {
              $category_name = $category->name;
            }

            $options[$category_name] = $product_link;
            ksort($options);
          } ?>

          <?php foreach ($options as $name => $option) { ?>
            <option value="<?php echo esc_url($option); ?>">
              <?php echo esc_html($name); ?>
            </option>
          <?php } ?>

          <option value="<?php echo esc_url($brand_link); ?>">
            View all
          </option>
        </select>
      </form>
    </div>
  <?php } ?>

  <div class="accordion" tabindex="0">
    <label class="h4" for="products-select">I would like to see this design on a ...</label>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
      <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
    </svg>
  </div>

  <div class="panel"><?php echo do_shortcode('[wpforms id="19421"]') ?></div>

  <?php if ($cat_size_guide) { ?>
    <div class="accordion" tabindex="0">
      <h2 class="h4">Size guide (inches)</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel size-guide">
      <?php
      echo $cat_size_guide;
      ?>
    </div>
  <?php } ?>


  <?php if ($cat_description || $prod_description) { ?>
    <div class="accordion" tabindex="0">
      <h2 class="h4">Description</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel">
      <?php
      echo $prod_description;
      echo $cat_description;
      ?>
    </div>
  <?php } ?>

  <?php if ($cat_care_instructions) { ?>
    <div class="accordion" tabindex="0">
      <h2 class="h4">Care instructions</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel">
      <?php
      echo $cat_care_instructions;
      ?>
    </div>
  <?php } ?>

  <?php if ($cat_shipping_returns) { ?>
    <div class="accordion" tabindex="0">
      <h2 class="h4">Shipping and returns</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel">
      <?php
      echo $cat_shipping_returns;
      ?>
    </div>
  <?php } ?>

  <?php if ($cat_safety_information) { ?>
    <div class="accordion" tabindex="0">
      <h2 class="h4">Safety information</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>

    <div class="panel">
      <?php
      echo $cat_safety_information;
      ?>
    </div>
  <?php } ?>
</div>