<ul>
  <li><a href="/">Home</a></li>

  <li><a href="#" class="drop-down-trigger">Shop by animal</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <?php
        get_template_part('components/animal-menu-items');
        ?>
      </div>
    </ul>
  </li>

  <li><a href="#" class="drop-down-trigger">Clothing</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <?php
        get_template_part('components/clothing-menu-items');
        ?>
      </div>
    </ul>
  </li>

  <li><a href="#" class="drop-down-trigger">Home & Living</a>
    <ul class="drop-down hidden">
      <div class="inner-wrapper">
        <?php
        get_template_part('components/home-living-menu-items');
        ?>
      </div>
    </ul>
  </li>
</ul>