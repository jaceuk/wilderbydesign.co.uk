<?php
// print "<pre>";
// print_r($left_products);
// print "</pre>";

$args = array(
  'post_type' => 'product',
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'posts_per_page' => 8,
  'post_status' => 'publish',
  'tax_query' => array(array(
    'taxonomy' => 'product_tag',
    'field' => 'slug',
    'terms' => 'halloween'
  ))
);
$loop = new WP_Query($args);
$left_products = array_slice($loop->posts, 0, 4);
$right_products = array_slice($loop->posts, 4, 4);
?>

<section class="hero-section halloween">
  <div class="inner-wrapper">
    <div class="title-with-text">
      <h1 class="hero">Everyday is a treat</h1>
      <p class="h2">Halloween treats for dog lovers</p>

      <div class="actions">
        <a href="/product-tag/halloween-dog-t-shirts/" class="button">Shop t-shirts</a>
        <a href="/product-tag/halloween-dog-mugs/" class="button">Shop mugs</a>
      </div>
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