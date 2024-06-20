<?php
$left_products = get_field('hero_left_products');
$right_products = get_field('hero_right_products');

// print "<pre>";
// print_r($left_products);
// print "</pre>";
?>

<section class="hero-section">
  <div class="inner-wrapper">
    <?php the_title('<h1 class="hero">', '</h1>'); ?>

    <div class="tiles">
      <div class="col">
        <?php
        $size = 'medium';

        foreach ($left_products as $product) {
          $product = $product['product'];
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
          $product = $product['product'];
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