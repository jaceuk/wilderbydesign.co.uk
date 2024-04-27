<ul>
  <li><a href="/">Home</a></li>
  <li><span class="title">Clothing</span>
    <ul>
      <li><a href="/product-category/sweatshirts">Sweatshirts</a></li>
      <li><a href="/product-category/t-shirts">T-shirts</a></li>
    </ul>
  </li>

  <li><span class="title">Home & Living</span>
    <ul>
      <li><a href="/product-category/tote-bags">Tote Bags</a>
        <ul>
          <li><a href="/product-category/all-over-print-tote-bags">All Over Print Tote Bags</a></li>
          <li><a href="/product-category/eco-tote-bags">ECO Tote Bags</a></li>
        </ul>
      </li>
      <li><a href="/product-category/blankets">Blankets</a>
        <ul>
          <li><a href="/product-category/sherpa-blankets">Sherpa Blankets</a></li>
          <li><a href="/product-category/throw-blankets">Throw Blankets</a></li>
        </ul>
      </li>
      <li><a href="/product-category/drinkware">Drinkware</a>
        <ul>
          <li><a href="/product-category/coasters">Coasters</a></li>
          <li><a href="/product-category/mugs">Mugs</a></li>
        </ul>
      </li>
      <li><a href="/product-category/wall-art">Wall Art</a>
        <ul>
          <li><a href="/product-category/flags">Flags</a></li>
        </ul>
      </li>
      <li><a href="/product-category/beach-bath-towels">Beach/Bath Towels</a></li>
      <li><a href="/product-category/orangic-cotton-aprons">Organic Cotton Aprons</a></li>
    </ul>
  </li>

  <li><span class="title">Shop by animal</span>
    <ul>
      <?php
      $terms = get_terms('product_tag');

      if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
          $term_type = get_field('tag_type',  $term->taxonomy . '_' . $term->term_id);
          if (strtolower($term_type) === 'animal') {
            echo '<li><a href="/product-tag/' . $term->slug . '">' . $term->name . '</a></li>';
          }
        }
      }
      ?>
    </ul>

  <li><span class="title">Support</span>
    <ul>
      <li><a href="/contact">Contact us</a></li>
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