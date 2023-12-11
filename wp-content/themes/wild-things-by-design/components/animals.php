<section class="animals">
  <div class="title-bar">
    <h2 class="section-heading">Gifts for animal lovers</h2>

    <?php
    get_template_part('components/animal-select');
    ?>
  </div>

  <div class="row">

    <?php
    $terms = get_terms('product_tag');

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        get_template_part(
          'components/animal',
          null,
          array(
            'url' => $term->slug,
            'title' => $term->name,
            'term_id' => $term->term_id,
            'taxonomy' => $term->taxonomy
          )
        );
      }
    }
    ?>
  </div>
</section>