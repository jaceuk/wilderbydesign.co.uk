<?php

$args = array(
  'post_type' => 'product',
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'posts_per_page' => 8,
  'post_status' => 'publish',
);
$loop = new WP_Query($args);
$left_products = array_slice($loop->posts, 0, 4);
$right_products = array_slice($loop->posts, 4, 4);

global $LAUNCH_EVENT_DISCOUNT;
?>

<section class="hero-section black-friday">
  <div class="inner-wrapper">
    <div class="title-with-text">
      <p class="pre-text">Black Friday sale now on</p>
      <h1 class="super">Buy 2 get 1 free!</h1>
      <p class="sub-text">Amusing apparel for fun-loving history buffs</p>
    </div>

    <div class="tiles">
      <div class="col">
        <?php
        $size = 'medium';
        foreach ($left_products as $product) {
          $id = $product->ID;
          $url = $product->guid;
          $thumbnail_id = get_post_thumbnail_id($id);
        ?>
          <a href="<?php echo $url; ?>" class="tile">
            <?php
            if ($thumbnail_id) {
              echo wp_get_attachment_image($thumbnail_id, $size);
            } else {
              echo '<img class="hero-image" src="' . get_stylesheet_directory_uri() . '/images/placeholder.png" alt="" />';
            }
            ?>
          </a>
        <?php
        }
        ?>
      </div>

      <div class="col">
        <?php
        $size = 'medium';
        foreach ($right_products as $product) {
          $id = $product->ID;
          $url = $product->guid;
          $thumbnail_id = get_post_thumbnail_id($id);
        ?>
          <a href="<?php echo $url; ?>" class="tile">
            <?php
            if ($thumbnail_id) {
              echo wp_get_attachment_image($thumbnail_id, $size);
            } else {
              echo '<img class="hero-image" src="' . get_stylesheet_directory_uri() . '/images/placeholder.png" alt="" />';
            }
            ?>
          </a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>