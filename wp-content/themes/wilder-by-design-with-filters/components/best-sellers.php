<section class="products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Best Sellers</h2>
      <div class="divider"></div>
      <a href="/shop" class="more">View all</a>
    </div>

    <?php
    echo do_shortcode('[products limit="8" columns="4" orderby="popularity" best_selling="true" visibility="featured"]');
    ?>
  </div>
</section>