<section class="products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Featured</h2>
    </div>

    <?php
    echo do_shortcode('[products limit="4" columns="4" featured orderby="popularity" visibility="featured"]');
    ?>
  </div>
</section>