<ul>
  <li><a href="/">Home</a></li>

  <li><a href="#" class="drop-down-trigger">Clothing</a>
    <ul class="drop-down hidden">
      <?php
      get_template_part('components/clothing-menu-items');
      ?>
    </ul>
  </li>

  <li><a href="#" class="drop-down-trigger">Home & Living</a>
    <ul class="drop-down hidden">
      <?php
      get_template_part('components/home-living-menu-items');
      ?>
    </ul>
  </li>
</ul>