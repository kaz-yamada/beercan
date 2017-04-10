<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Beercan
 * @since 1.0
 * @version 1.0
 */
?>
<div class="custom-header">

    <div class="custom-header-media">
        <?php the_custom_header_markup(); ?>

        <?php if ( ( beercan_is_frontpage() || ( is_home() && is_front_page() ) ) && has_custom_header() ) : ?>
            <a href="#content" class="menu-scroll-down">
                <?php echo beercan_get_svg( array( 'icon' => 'arrow-right' ) ); ?>
                <span class="screen-reader-text"><?php _e( 'Scroll down to content', 'beercan' ); ?></span>
            </a>
        <?php endif; ?>
    </div>


    <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
