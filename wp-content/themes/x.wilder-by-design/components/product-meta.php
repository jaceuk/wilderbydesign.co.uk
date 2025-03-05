<?php
// get parent category
$categories = get_the_terms($post->ID, 'product_cat');

foreach ($categories as $category) {
  $cat_id =  $category->term_id;
  $cat_name = $category->slug;
  break;
}
?>

<div class="product-meta">

  <?php
  if ($cat_name === 'premium-t-shirts' || $cat_name === 'sweatshirts' || $cat_name === 'vintage-t-shirts') {
  ?>

    <div class="accordion" tabindex="0">
      <h2 class="h4">Size guide (inches)</h2>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
      </svg>
    </div>
    <div class="panel">
      <?php
      if ($cat_name === 'premium-t-shirts') get_template_part('components/bella-canvas-3001-size-guide');
      if ($cat_name === 'sweatshirts') get_template_part('components/gildan-18000-size-guide');
      if ($cat_name === 'vintage-t-shirts') get_template_part('components/comfort-colors-1717-size-guide');
      ?>
    </div>
  <?php } ?>

  <div class="accordion" tabindex="0">
    <h2 class="h4">Description</h2>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
      <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
    </svg>
  </div>
  <div class="panel">
    <?php
    echo wc_get_product($post->ID)->get_description();
    echo get_field('description_for_the_single_product_page', 'product_cat_' . $cat_id);
    ?>
  </div>

  <div class="accordion" tabindex="0">
    <h2 class="h4">Shipping and returns</h2>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
      <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
    </svg>
  </div>
  <div class="panel">
    <p>We are happy to ship your purchase to anywhere in the world with competitive shipping rates and delivery times.</p>
    <p>Delivery times will fluctuate based on time of year and demand. You will see an estimated delivery time with the final cost when you Checkout.</p>
  </div>
</div>