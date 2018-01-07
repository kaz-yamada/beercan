<?php
/**
 * Displays content for front page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Beercan
 * @since 1.0
 * @version 1.0
 */

?>
<div class="grid-container grid-padding-x">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'cell' ); ?>>
		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'beercan' ), array(
							'span' => array(
								'class' => array(),
							),
						)
					), get_the_title()
				)
			);

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beercan' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php beercan_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
