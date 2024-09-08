<header class="animals-header">
  <?php the_title('<h1 class="animals-header">', '</h1>'); ?>
  <div class="text">
    If we're missing your favourite animal or a particular product for your favourite animal please head over to our <a href="/contact">contact page</a> and let us know and we'll see what we can do.
  </div>
</header>

<div class="animals">
  <?php
  $terms = get_terms('product_tag');

  if (!empty($terms) && !is_wp_error($terms)) {
    echo '<ul>';
    foreach ($terms as $term) {
      $term_type = get_field('tag_type',  $term->taxonomy . '_' . $term->term_id);
      if (strtolower($term_type) === 'animal') {
  ?>
        <li class="product">
          <a href="/product-tag/<?php echo $term->slug; ?>">
            <?php
            $image = get_field('image', $term->taxonomy . '_' . $term->term_id);
            $size = 'medium';

            if (!empty($image)) {
              echo wp_get_attachment_image($image, $size);
            } else {
              echo '<img class="hero-image" src="' . get_stylesheet_directory_uri() . '/images/placeholder.png" alt="" />';
            }
            ?>

            <div class="name"><?php echo $term->name; ?></div>
          </a>
        </li>
  <?php
        echo '</ul>';
      }
    }
  }
  ?>
</div>