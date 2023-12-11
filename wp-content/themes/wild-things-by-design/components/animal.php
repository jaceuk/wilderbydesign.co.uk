<div class="animal">
  <a class="image" href="/product-tag/<?php echo $args['url']; ?>">
    <?php
    $image = get_field('image', $args['taxonomy'] . '_' . $args['term_id']);
    $size = 'medium';

    if (!empty($image)) {
      echo wp_get_attachment_image($image, $size);
    }
    ?>
  </a>

  <h3><?php echo $args['title']; ?></h3>

  <a class="button outline" href="/product-tag/<?php echo $args['url']; ?>">Shop now</a>
</div>