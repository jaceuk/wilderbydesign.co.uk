<?php
$collections = get_field('collections');
$collections_title = get_field('collections_title');
?>

<section class="home-section products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2><?php echo $collections_title; ?></h2>
      <div class="divider"></div>
      <a href="/collections" class="more">View all</a>
    </div>

    <div class="col-2">
      <?php
      $size = 'large';

      foreach ($collections as $collection) {
        $id = $collection['collection'];
        $term_name = get_term($id)->name;
        $term_meta = get_term_meta($id);
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
          <?php echo $term_name; ?>
        </a>
      <?php
      }
      ?>
    </div>
  </div>
  </div>
</section>