<?php
// get parent category
$categories = get_the_terms($post->ID, 'product_cat');

foreach ($categories as $category) {
  $cat_id =  $category->term_id;
}

$cat_size_guide = get_field('cat_size_guide', 'product_cat_' . $cat_id);
$prod_description = wc_get_product($post->ID)->get_description();
$cat_description = get_field('description_for_the_single_product_page', 'product_cat_' . $cat_id);
$cat_care_instructions = get_field('cat_care_instructions', 'product_cat_' . $cat_id);
$cat_shipping_returns = get_field('cat_shipping_returns', 'product_cat_' . $cat_id);
$cat_safety_information = get_field('cat_safety_information', 'product_cat_' . $cat_id);
?>

<?php
get_template_part('components/benefits-beneath-button');
?>

<div class="product-meta">
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