<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Beercan
 * @since 1.0
 * @version 1.0
 */
?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'beercan' ); ?>">
    <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
        <?php
        echo beercan_get_svg( array( 'icon' => 'bars' ) );
        echo beercan_get_svg( array( 'icon' => 'close' ) );
        _e( 'Menu', 'beercan' );
        ?>
    </button>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'top',
        'menu_id' => 'top-menu',
    ) );
    ?>
</nav><!-- #site-navigation -->
