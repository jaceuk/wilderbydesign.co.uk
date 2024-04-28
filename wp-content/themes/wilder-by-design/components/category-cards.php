<?php
$size = 'large';

foreach ($args['value'] as $arg) {
  $arg['type'] == 'Tag' ? $term_id = $arg['tag'] : $term_id = $arg['category'];
  $term_name = get_term($term_id)->name;
  $term_vals = get_term_meta($term_id);
  $arg['type'] == 'Tag' ? $image_id = $term_vals['image'][0] : $image_id = $term_vals['thumbnail_id'][0];
  $url = get_tag_link($term_id);

  // print "<pre>";
  // print_r($term_vals);
  // print "</pre>";
?>

  <a class="category-card" href="<?php echo $url; ?>">
    <div class="image">
      <?php
      if (!empty($image_id)) {
        echo wp_get_attachment_image($image_id, $size);
      }
      ?>
    </div>
    <dv class="h4"><?php echo $term_name; ?></dv>
  </a>

<?php
}
?>