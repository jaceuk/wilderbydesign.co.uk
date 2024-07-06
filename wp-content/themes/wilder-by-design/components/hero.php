<?php
// print "<pre>";
// print_r($left_products);
// print "</pre>";

$args = array(
  'post_type' => 'product',
  'meta_key' => 'total_sales',
  'orderby' => 'meta_value_num',
  'posts_per_page' => 8,
);
$loop = new WP_Query( $args );
$left_products = array_slice($loop->posts,0,4);
$right_products = array_slice($loop->posts,4,4);
?>

<section class="hero-section">
  <div class="inner-wrapper">
    <?php the_title('<h1 class="hero">', '</h1>'); ?>

    <div class="tiles">
      <div class="col">
        <?php
        $size = 'medium';
        foreach($left_products as $product) {
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
        foreach($right_products as $product) {
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