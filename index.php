<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 */

get_header();
?>
<div id="content-inner" class="grid-container">
	<div class="grid-x grid-padding-x">
		<div id="primary" class="content-area cell auto">
			<main id="main" class="site-main grid-x grid-margin-x large-up-3 medium-up-2">
				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile;
				else :
					get_template_part( 'template-parts/post/content', 'none' );
				endif;
				?>

				<div class="grid-container pagination-wrapper">
					<?php
					beercan_posts_pagination();
					?>
				</div>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!--.grid-x-->
</div><!--#content-inner-->
<?php
get_footer();
