<?php
$cat_slug = 'hoodies';
$taxonomy = 'product_cat';

$cat_object = get_term_by('slug', $cat_slug, $taxonomy);

// Construct the ACF-compatible ID for the term.
$acf_term_id = $cat_object->taxonomy . '_' . $cat_object->term_id;

$cat_size_guide = get_field('cat_size_guide', $acf_term_id);
$cat_description = get_field('description_for_the_single_product_page', $acf_term_id);
$cat_care_instructions = get_field('cat_care_instructions', $acf_term_id);
$cat_shipping_returns = get_field('cat_shipping_returns', $acf_term_id);
?>

<section class="about">
  <div class="inner-wrapper">
    <div class="about-row">
      <div class="left">
        <div class="image">
          <img class="big-logo" src="<?php echo get_stylesheet_directory_uri() ?>/images/big-logo.svg" alt="" />
        </div>
      </div>

      <div class="right">
        <div class="text">
          <h2 class="h1">About our Hoodies</h2>

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

            <?php if ($cat_description) { ?>
              <div class="accordion" tabindex="0">
                <h2 class="h4">Description</h2>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                  <path d="M480-371.69 267.69-584 296-612.31l184 184 184-184L692.31-584 480-371.69Z" />
                </svg>
              </div>

              <div class="panel">
                <?php
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>