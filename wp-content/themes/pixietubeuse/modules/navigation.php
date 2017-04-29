<nav class="desktop-navigation">
    <div class="content">
        <?php wp_nav_menu( array( 'theme_location' => 'menu' ) ); ?>
        <div class="boutons-menu">
            <?php wp_nav_menu( array( 'theme_location' => 'reseauxSociaux' ) ); ?>
        </div>
    </div>
</nav>
<nav class="mobile-navigation">
    <div class="burger-navigation">
        <div class="burger-line-navigation"></div>
        <div class="burger-line-navigation"></div>
        <div class="burger-line-navigation"></div>
    </div>
    <div class="content">
        <div class="dashicons dashicons-no-alt mobile-navigation-btn-close"></div>
        <?php wp_nav_menu( array( 'theme_location' => 'menu' ) ); ?>
        <div class="boutons-menu">
            <?php wp_nav_menu( array( 'theme_location' => 'reseauxSociaux' ) ); ?>
        </div>
    </div>
</nav>