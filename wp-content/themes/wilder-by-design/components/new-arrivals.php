<section class="products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>New Arrivals</h2>
      <div class="divider"></div>
      <a href="/product-category/t-shirts/?orderby=date" class="more">View all</a>
    </div>

    <?php
    echo do_shortcode('[products limit="8" columns="4" orderby="date" category="t-shirts"]');
    ?>
  </div>
</section>