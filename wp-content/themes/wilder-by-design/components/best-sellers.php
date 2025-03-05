<section class="products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2>Best Sellers</h2>
      <div class="divider"></div>
      <a href="/shop" class="more">View all</a>
    </div>

    <?php
    echo do_shortcode('[products limit="8" columns="4" orderby="popularity"]');
    // $best_sellers = get_best_selling_products_last_2_months();

    // if ($best_sellers->have_posts()) :
    //   while ($best_sellers->have_posts()) : $best_sellers->the_post();
    //     wc_get_template_part('content', 'product'); // Display product
    //   endwhile;
    //   wp_reset_postdata();
    // else :
    //   echo '<p>No best-selling products found.</p>';
    // endif;
    ?>
  </div>
</section>