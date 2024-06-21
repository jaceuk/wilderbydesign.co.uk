<?php
$collections = get_field('collections');
$collections_title = get_field('collections_title');
?>


<header>
  <?php the_title('<h1>', '</h1>'); ?>
</header>

<div class="col-2">
  <?php
  $size = 'large';
  $terms = get_terms(array(
    'taxonomy' => 'product_tag',
    'order'   => 'DESC'
  ));

  $collection_ids = [];
  if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $term_type = get_field('tag_type',  $term->taxonomy . '_' . $term->term_id);

      if (strtolower($term_type) === 'collection') {
        $term_meta = get_term_meta($term->term_id);
        $url = get_tag_link($id);
        $image_id = $term_meta['image'][0];
  ?>
        <a class="collection-card" href="<?php echo $url; ?>">
          <div class="image">
            <?php
            if (!empty($image_id)) {
              echo wp_get_attachment_image($image_id, $size);
            }
            ?>
          </div>
          <h2><?php echo $term->name; ?></h2>
          <p><?php echo $term->description; ?></p>
        </a>
  <?php
      }
    }
  }
  ?>
</div>