<section class="animals">
  <div class="title-bar">
    <h2 class="section-heading">Gifts for animal lovers</h2>

    <?php
    get_template_part('components/animal-select');
    ?>
  </div>

  <div class="row">
    <?php
    get_template_part(
      'components/animal',
      null,
      array(
        'url' => 'tiger',
        'title' => 'Tiger',
      )
    );

    get_template_part(
      'components/animal',
      null,
      array(
        'url' => 'tiger',
        'title' => 'Tiger',
      )
    );

    get_template_part(
      'components/animal',
      null,
      array(
        'url' => 'tiger',
        'title' => 'Tiger',
      )
    );

    get_template_part(
      'components/animal',
      null,
      array(
        'url' => 'tiger',
        'title' => 'Tiger',
      )
    );
    ?>
  </div>
</section>