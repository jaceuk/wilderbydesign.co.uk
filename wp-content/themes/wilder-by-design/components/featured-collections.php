<section class="home-section products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Latest Collections</h2>
      <div class="divider"></div>
      <a href="/collections" class="more">View all</a>
    </div>

    <?php
    $category = get_term_by('slug', 'collections', 'product_cat');
    $cat_id = $category->term_id;
    $cats = get_categories(array(
      'taxonomy' => 'product_cat',
      'orderby' => 'date',
      'order'   => 'ASC',
      'parent' => $cat_id,
      'number' => 4,
    ));

    echo '<div class="col-4">';

    $size = 'large';

    foreach ($cats as $cat) {
      $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
    ?>
      <a class="personalised-card" href="/product-category/collections/<?php echo $cat->slug; ?>">
        <div class="image">
          <?php
          if (!empty($thumbnail_id)) {
            echo wp_get_attachment_image($thumbnail_id, $size);
          }
          ?>
        </div>
        <h3 class="body"><?php echo $cat->name; ?></h3>
      </a>
    <?php
    }
    echo '</div>';
    ?>
  </div>
  </div>
</section>