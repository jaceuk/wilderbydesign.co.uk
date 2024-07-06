<?php
$collections = get_field('collections');
$collections_title = get_field('collections_title');
?>

<header>
  <?php the_title('<h1 class="collections-header">', '</h1>'); ?>
</header>

<?php
$category = get_term_by('slug', 'collections', 'product_cat');
$cat_id = $category->term_id;
$cats = get_categories(array(
  'taxonomy' => 'product_cat',
  'orderby' => 'id',
  'order'   => 'DESC',
  'parent' => $cat_id,
));

echo '<div class="collections">';

foreach ($cats as $cat) {
?>
  <section class="products-section archive">
    <div>
      <div class="title">
        <h2><?php echo $cat->name; ?></h2>
        <div class="divider"></div>
        <a href="/product-category/<?php echo $cat->slug; ?>" class="more">View all (<?php echo $cat->count; ?> results)</a>
      </div>
      <?php
      echo do_shortcode('[products limit="4" columns="4" orderby="popularity" category="' . $cat->slug . '"]');
      ?>
    </div>
  </section>
<?php
}
echo '</div>';
?>