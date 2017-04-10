<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package beercan
 */
if ( !is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>
<div id="sidebar" class="columns large-4 medium-4 small-4" >
    <aside id="secondary" class="widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside><!-- #secondary -->
</div><!-- #sidebar -->