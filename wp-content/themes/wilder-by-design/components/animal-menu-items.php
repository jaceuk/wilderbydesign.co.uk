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
