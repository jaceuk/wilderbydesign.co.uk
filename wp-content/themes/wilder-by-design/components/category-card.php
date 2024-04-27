<a class="category-card" href="<?php echo $args['url']; ?>">
  <?php
  echo wp_get_attachment_image($args['image_id'], $size = 'medium');
  ?>
  <div class="h4">
    <?php echo $args['text']; ?>
  </div>
</a>