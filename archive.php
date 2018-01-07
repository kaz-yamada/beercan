<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

get_header();
?>

<div id="content-inner" class="grid-container">
	<div class="grid-x grid-padding-x grid-padding-y grid-margin-x">
		<div id="primary" class="content-area cell auto">
			<main id="main" class="site-main grid-y grid-padding-y grid-margin-y">

				<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;

					the_posts_navigation();
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
