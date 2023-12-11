<form>
  <label for="animal-select" class="sr-only">Shop by animal:</label>

  <select name="animal" id="animal-select" onchange="redirect(this.value)">
    <option value="">-- Shop by animal --</option>

    <?php
    $terms = get_terms('product_tag');

    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
      }
    }
    ?>
  </select>
</form>

<script>
  function redirect(val) {
    window.location.href = '/product-tag/' + val;
  }
</script>