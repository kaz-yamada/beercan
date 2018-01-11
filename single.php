<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Beercan
 */

get_header();
?>

<div id="content-inner" class="grid-container">
	<div class="grid-x grid-padding-x grid-padding-y">
		<div id="primary" class="content-area cell auto">
			<main id="main" class="site-main grid-container grid-padding-x grid-padding-y grid-margin-y">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/post/content-single', get_post_type() );
					?>
					<div class="cell">
						<?php
						the_post_navigation( array(
							'prev_text' => '<i class="fa fa-chevron-left" aria-hidden="true"></i> %title',
							'next_text' => '%title <i class="fa fa-chevron-right" aria-hidden="true"></i>',
						) );
						?>
					</div>
					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .grid-x -->
</div><!--#content-inner-->
<?php
get_footer();
