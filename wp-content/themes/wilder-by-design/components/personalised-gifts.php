<?php
$personalised_tags = get_field('personalised_tags');
$personalised_title = get_field('personalised_title');
$personalised_text = get_field('personalised_text');
?>

<section class="home-section products-section">
  <div class="inner-wrapper">
    <div class="title">
      <h2><?php echo $personalised_title; ?></h2>
    </div>

    <div class="col-2">
      <div class="text">
        <?php echo $personalised_text; ?>
      </div>
      <div class="col-2">
        <?php
        $size = 'large';

        foreach ($personalised_tags as $personalised_tag) {
          $id = $personalised_tag['personalised_tag'];
          $term_name = get_term($id)->name;
          $term_meta = get_term_meta($id);
          $url = get_tag_link($id);
          $image_id = $term_meta['image'][0];
        ?>
          <a class="personalised-card" href="<?php echo $url; ?>">
            <div class="image">
              <?php
              if (!empty($image_id)) {
                echo wp_get_attachment_image($image_id, $size);
              }
              ?>
            </div>
            <h3 class="body"><?php echo $term_name; ?></h3>
          </a>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>