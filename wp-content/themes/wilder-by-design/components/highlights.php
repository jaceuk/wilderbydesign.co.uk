<section class="highlights">
  <?php
  if (have_rows('highlights')) :
    while (have_rows('highlights')) : the_row();

      // Load sub field value.
      $title = get_sub_field('title');
      $image = get_sub_field('image');
      $url = get_sub_field('url');
      $size = 'medium';
      // Do something...
  ?>
      <div class="highlight">
        <a class="image" href="<?php echo $url; ?>">
          <?php
          if (!empty($image)) {
            echo wp_get_attachment_image($image, $size);
          }
          ?>
        </a>
        <h2><?php echo $title; ?></h2>
        <a class="button outline" href="<?php echo $url; ?>">Shop now</a>
      </div>
  <?php
    endwhile;
  else :
  endif;
  ?>
</section>