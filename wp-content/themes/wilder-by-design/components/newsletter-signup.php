<section class="newsletter-signup">
  <div class="inner-wrapper">
    <h2>Signup for exclusive deals</h2>
    <p>Sign up to our newsletter to stay up to date on new arrivals and get exclusive offers. You can cancel at any time.</p>

    <?php
    if (file_exists('c:\windows')) {
      $form_id = 993;
    } else {
      $form_id = 1007;
    }

    echo do_shortcode('[wpforms id=' . $form_id . ']');
    ?>
  </div>
</section>