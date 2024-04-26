<ul>
  <li><a href="/">Home</a></li>

  <li><a href="#" class="drop-down-trigger">Shop by animal</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
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
      </div>
    </ul>
  </li>

  <?php
  $taxonomy = 'product_cat';
  $terms = get_terms($taxonomy);
  ?>

  <li><a href="#" class="drop-down-trigger">Clothing</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <li><a href="/product-category/sweatshirts">Sweatshirts</a></li>
        <li><a href="/product-category/t-shirts">T-shirts</a></li>
      </div>
    </ul>
  </li>

  <li><a href="#" class="drop-down-trigger">Home & Living</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <li><a href="/product-category/bags">Bags</a>
          <ul>
            <li><a href="/product-category/all-over-print-tote-bags">All Print Tote Bags</a></li>
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
      </div>
    </ul>
  </li>
</ul>