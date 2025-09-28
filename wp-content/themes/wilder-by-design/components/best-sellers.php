<section class="products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Best Sellers</h2>
      <div class="divider">&nbsp;</div>
      <a href="/product-category/t-shirts" class="more">View all</a>
    </div>

    <?php
    echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]');
    ?>
  </div>
</section>