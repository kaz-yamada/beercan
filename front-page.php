<?php
/**
 * Front Page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
