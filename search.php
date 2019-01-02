<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Beercan
 */

get_header();
?>
<div id="content-inner" class="grid-container">
	<div class="grid-x grid-padding-x grid-padding-y" >
		<section id="primary" class="content-area cell auto">
			<main id="main" class="site-main grid-y grid-margin-y">
				<?php if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						// the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						the_post();
						get_template_part( 'template-parts/post/content-search' );

					endwhile;
					?>
					<div class="grid-container pagination-wrapper">
						<?php beercan_posts_pagination(); ?>
					</div>

					<?php
					else :
						echo 'No results';
						get_template_part( 'template-parts/post/content', 'none' );
					endif;
					?>
			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();
