<?php
$collections = get_field('collections');
$collections_title = get_field('collections_title');
?>

<header>
  <?php the_title('<h1>', '</h1>'); ?>
</header>

<?php
$terms = get_terms(array(
  'taxonomy' => 'product_tag',
  'orderby' => 'date',
  'order'   => 'ASC'
));

echo '<div class="collections">';

$collection_ids = [];
if (!empty($terms) && !is_wp_error($terms)) {
  foreach ($terms as $term) {
    $term_type = get_field('tag_type',  $term->taxonomy . '_' . $term->term_id);

    if (strtolower($term_type) === 'collection') {
      $term_meta = get_term_meta($term->term_id);
      $url = get_tag_link($id);

      $args = array(
        'posts_per_page' => -1,
        'post_type' => 'product',
        'product_tag' => $term->slug
      );
      $query = new WP_Query($args);

      $count = $query->post_count;
?>
      <section class="products-section archive">
        <div>
          <div class="title">
            <h2><?php echo $term->name; ?></h2>
            <div class="divider"></div>
            <a href="/product-tag/<?php echo $term->slug; ?>" class="more">View all (<?php echo $count; ?> results)</a>
          </div>
          <?php
          echo do_shortcode('[products limit="4" columns="4" orderby="popularity" tag="' . $term->slug . '"]');
          ?>
        </div>
      </section>
<?php
    }
  }
}

echo '</div>';
?>