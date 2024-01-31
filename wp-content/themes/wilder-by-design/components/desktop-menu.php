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

  <li><a href="#" class="drop-down-trigger">Shop by category</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <?php
        $terms = get_terms('product_cat');

        if (!empty($terms) && !is_wp_error($terms)) {
          foreach ($terms as $term) {
            if (!str_contains($term->name, 'Uncategorised')) {
              echo '<li><a href="/product-category/' . $term->slug . '">' . $term->name . '</a></li>';
            }
          }
        }
        ?>
      </div>
    </ul>
  </li>
</ul>