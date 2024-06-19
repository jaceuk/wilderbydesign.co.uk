<?php

/**
 * Template Name: Home
 */

get_header();

defined('ABSPATH') || exit;
get_header('shop');
?>

<main>

  <?php
  get_template_part('components/hero');
  ?>

  <?php
  get_template_part('components/benefits-slim');
  ?>

  <section class="products-section">
    <div class="inner-wrapper">
      <div class="title">
        <h2>Best Sellers</h2>
        <div class="divider"></div>
        <a href="/shop" class="more">View all <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-forward.svg" alt="" /></a>
      </div>

      <?php
      echo do_shortcode('[products limit="8" columns="4" orderby="popularity" best_selling="true"]');
      ?>
    </div>
  </section>

  <section class="home-section products-section">
    <div class="inner-wrapper">
      <div class="title">
        <h2>Latest Collections</h2>
        <div class="divider"></div>
        <a href="/collections" class="more">View all <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-forward.svg" alt="" /></a>
      </div>

      <div class="col-2">
        <?php
        $collections = get_field_object('collections');
        get_template_part('components/collection-card', null, $collections);
        ?>
      </div>
    </div>
    </div>
  </section>

  <section class="home-section products-section">
    <div class="inner-wrapper">
      <div class="title">
        <h2>Personalised Gifts</h2>
      </div>

      <div class="col-2">
        <div class="text">
          <p>A personalised gift shows thoughtfulness and effort, making your loved ones feel extra special.</p>
          <p>You can also treat yourself and create something that’s uniquely yours.</p>
          <p>Some of our products have optional personalisation where you can add a name to the design.</p>
          <p>We also have a range of fully personalised products for pet owners that feature a photo of their pet.</p>
        </div>
        <div class="col-2">
          <?php
          $callouts = get_field_object('top_callouts');
          get_template_part('components/category-cards', null, $callouts);
          ?>
        </div>
      </div>
    </div>
  </section>




</main>

<?php
get_footer();
