<div class="nav-header">
    <div class="container-fluid">
        <div id="burger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

        <a id="search" href="#"><span class="glyphicon glyphicon-search" aria-hidden="true"></span><span class="sr-only">Search</span></a>

        <a id="logo" href="/"><span class="sr-only">XXXX homepage</span></a>
    </div>
</div>

<div id="search-bar" class="search-bar">
    <div class="container-fluid">
        <form class="search-form" role="search" method="get" action="/">
            <input type="hidden" value="1" name="sentence" />
            <div class="form-group">
                <label for="search-field" class="sr-only">Search for:</label>
                <input id="search-field" required type="text" class="form-control search-field" placeholder="Search ..." value="" name="s">
            </div>
            <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </form>
    </div>
</div>

<nav id="mega-menu" class="mega-menu">
    <div class="container-fluid">
        <div class="row">
            <div class="menu-container">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'menu-1'
                    ) );
                ?>
            </div>
        </div>
    </div>
</nav>