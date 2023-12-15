<section class="animals">
  <div class="title-bar">
    <h2 class="section-heading">Gifts for animal lovers</h2>

    <?php
    get_template_part('components/animal-select');
    ?>
  </div>

  <div class="row">

    <?php
    $terms = get_terms('product_tag');

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
    ?>
        <div class="animal">
          <a class="image" href="/product-tag/<?php echo $term->slug; ?>">
            <?php
            $image = get_field('image', $term->taxonomy . '_' . $term->term_id);
            $size = 'medium';

            if (!empty($image)) {
              echo wp_get_attachment_image($image, $size);
            }
            ?>
          </a>
          <h3><?php echo $term->name; ?></h3>
          <a class="button outline" href="/product-tag/<?php echo $term->slug; ?>">Shop now</a>
        </div>
    <?php
      }
    }
    ?>
  </div>
</section>