<?php
$collections = get_field('collections');
$collections_title = get_field('collections_title');
?>

<header>
  <?php the_title('<h1 class="collections-header">', '</h1>'); ?>
</header>

<?php
$args = array(
  'taxonomy' => 'product_tag',
  'orderby' => 'id',
  'order'   => 'DESC',
  'meta_key'      => 'tag_type',
  'meta_value'    => 'Collection'

);
$collections = get_terms($args);

echo '<div class="collections">';

foreach ($collections as $collection) {
?>
  <section class="products-section archive">
    <div>
      <div class="title">
        <h2><?php echo $collection->name; ?></h2>
        <div class="divider"></div>
        <a href="/product-tag/<?php echo $collection->slug; ?>" class="more">View all (<?php echo $collection->count; ?> results)</a>
      </div>
      <?php
      echo do_shortcode('[products limit="4" columns="4" orderby="popularity" tag="' . $collection->slug . '"]');
      ?>
    </div>
  </section>
<?php
}
echo '</div>';
?>