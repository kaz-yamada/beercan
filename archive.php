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
			<main id="main" class="site-main grid-x grid-padding-y grid-margin-x grid-margin-y large-up-2">

				<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;
				?>
				<div class="grid-container pagination-wrapper">
					<?php beercan_posts_pagination();?>
				</div>
				<?php
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
