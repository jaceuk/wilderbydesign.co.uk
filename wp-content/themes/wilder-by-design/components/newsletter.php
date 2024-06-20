<section class="newsletter-section">
  <div class="inner-wrapper">
    <img class="hero-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/newsletter.png" alt="" />
    <div class="newsletter">
      <h2>Signup for exclusive deals</h2>
      <p>Sign up to our newsletter to stay up to date on new arrivals and get exclusive offers. You can cancel at any time.</p>

      <?php
      echo do_shortcode('[wpforms id=1007]');
      ?>
    </div>
  </div>
</section>