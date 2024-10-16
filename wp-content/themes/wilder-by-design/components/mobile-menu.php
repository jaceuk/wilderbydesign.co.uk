<ul>
  <li class="mobile-currency-switcher"><?php echo do_shortcode('[woo_multi_currency_layout5 flag_size=0.4]'); ?></li>
  <li><a href="/">Home</a></li>

  <li><a href="/shop-by-animal">Shop by Animal</a></li>

  <li><span class="title">Clothing</span>
    <ul>
      <?php
      get_template_part('components/clothing-menu-items');
      ?>
    </ul>
  </li>

  <li><span class="title">Home & Living</span>
    <ul>
      <?php
      get_template_part('components/home-living-menu-items');
      ?>
    </ul>
  </li>

  <li><span class="title">Support</span>
    <ul>
      <li><a href="/contact">Contact us</a></li>
      <li><a href="/collections">Collections</a></li>
      <li><a href="/faq">FAQ</a></li>
      <li><a href="/returns">Returns policy</a></li>
      <li><a href="/shipping">Shipping</a></li>
    </ul>
  </li>

  <li><span class="title">Legal notices</span>
    <ul>
      <li><a href="/privacy">Privacy policy</a></li>
      <li><a href="/terms">Terms of service</a></li>
      <li><a href="/sitemap">Sitemap</a></li>
    </ul>
  </li>
</ul>