<section class="category-callouts">
  <?php
  $size = 'large';

  foreach ($args['value'] as $arg) {
    $term_id = $arg['category'];
    $url = $arg['url'];
    $term_name = get_term($term_id)->name;
    $term_vals = get_term_meta($term_id);
    $image_id = $term_vals['thumbnail_id'][0];
  ?>

    <a class="category-callout" href="<?php echo $url; ?>">
      <div class="image">
        <?php
        if (!empty($image_id)) {
          echo wp_get_attachment_image($image_id, $size);
        }
        ?>
      </div>
      <h2 class="title"><?php echo $term_name; ?><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-forward.svg" alt="" /></h2>
    </a>

  <?php
  }
  ?>


</section>