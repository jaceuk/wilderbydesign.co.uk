<section class="callouts animals">
  <?php
  $size = 'large';


  $terms = get_terms('product_tag');

  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $term_vals = get_term_meta($term->term_id);
      $image_id = array_key_exists('image', $term_vals) && $term_vals['image'][0] ? $term_vals['image'][0] : 6;
      $term_type = get_field('tag_type',  $term->taxonomy . '_' . $term->term_id);

      if (strtolower($term_type) === 'animal') { ?>

        <a class="callout" href="/product-tag/<?php echo $term->slug; ?>">
          <div class="image">
            <?php
            echo wp_get_attachment_image($image_id, $size);
            ?>
          </div>
          <h2 class="title"><?php echo $term->name; ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-forward.svg" alt="" /></h2>
        </a>

  <?php }
    }
  }
  ?>
</section>