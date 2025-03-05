<section class="home-section products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Latest Collections</h2>
      <div class="divider"></div>
      <a href="/collections" class="more">View all</a>
    </div>

    <?php
    $args = array(
      'taxonomy' => 'product_tag',
      'orderby' => 'id',
      'order'   => 'DESC',
      'number' => 4,
      'meta_key'      => 'tag_type',
      'meta_value'    => 'Collection'

    );
    $collections = get_terms($args);

    echo '<div class="col-4">';

    $size = 'medium';

    foreach ($collections as $collection) {
      $image_id = get_term_meta($collection->term_id, 'image', true);
    ?>
      <a class="personalised-card" href="/product-tag/<?php echo $collection->slug; ?>">
        <div class="image">
          <?php
          if ($image_id) {
            echo wp_get_attachment_image($image_id, $size);
          } else {
            echo '<img class="hero-image" src="' . get_stylesheet_directory_uri() . '/images/placeholder.png" alt="" />';
          }
          ?>
        </div>
        <h3 class="body"><?php echo $collection->name; ?></h3>
      </a>
    <?php
    }
    echo '</div>';
    ?>
  </div>
  </div>
</section>