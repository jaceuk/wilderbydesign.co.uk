<?php

/**
 * Template Name: Home
 */

get_header();

defined('ABSPATH') || exit;
get_header('shop');
?>

<main>

  <section class="home-section hero-section">
    <div class="inner-wrapper">
      <?php the_title('<h1 class="hero">', '</h1>'); ?>
      <img class="hero-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero.jpg" alt="" />
    </div>
  </section>

  <section class="home-section personalisation-section">
    <div class="inner-wrapper">
      <h2>Personalised Gifts</h2>
      <div class="col-2">
        <div class="text">
          <p>A personalised gift shows thoughtfulness and effort, making your loved ones feel extra special.</p>
          <p>You can also treat yourself and create something that’s uniquely yours.</p>
          <p>Most of our products have optional personalisation where you can add a name to the design.</p>
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



  <section class="home-section category-section">
    <div class="inner-wrapper">
      <h2>Gifts for Animal Lovers</h2>
      <div class="col-4">
        <?php
        $callouts = get_field_object('bottom_callouts');
        get_template_part('components/category-cards', null, $callouts);
        ?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
