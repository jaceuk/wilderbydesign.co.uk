<section class="products-section">
  <div class="inner-wrapper">
    <div class="title-row">
      <div class="title">
        <h2>Best Sellers</h2>
        <div class="divider">&nbsp;</div>
        <a href="/product-category/hoodies" class="more">View all</a>
      </div>

      <button class="link" onclick="openDialog('cant-find-dialog')">More designs?</button>
    </div>


    <?php
    echo do_shortcode('[products limit="12" columns="4" orderby="popularity" category="hoodies"]');
    ?>
  </div>
</section>